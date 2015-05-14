<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Payments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PaymentsController extends AbstractActionController
{
    /**
     * Index
     * Overview of all the payments
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        // TransactionSearch
        $transactionSearch  =   new \SpeckPaypal\Request\TransactionSearch();
        $transactionSearch->setStartDate('2014-12-28T00:00:00Z');
        

        $paypalRequest      =   $this->getServiceLocator()->get('SpeckPaypal\Service\Request');
        $response           =   $paypalRequest->send($transactionSearch);

        return new ViewModel([
            'transactions'  =>  $response->getResults()
        ]);
    }

    /**
     * Create
     * Create a new PayPal Payment
     *
     * @return \Zend\Http\Response
     */
    public function createAction()
    {
        // PayPal Request
        $paypalRequest = $this->getServiceLocator()->get('SpeckPaypal\Service\Request');

        // Paypal PaymentItem
        $item = new \Payments\Model\PaymentsModel();
        $item = $item->findById(1);
        

        // Set the PaymentDetails (MaxCost of all Items)
        $paymentDetails = new \SpeckPaypal\Element\PaymentDetails([
            'amt' => $item->getAmt()
        ]);

        // Set the items
        $paymentDetails->setItems([ $item ]);

        // Create a new ExpressCheckOut
        $express = new \SpeckPaypal\Request\SetExpressCheckout(['paymentDetails' => $paymentDetails]);
        $express->setReturnUrl($this->url()->fromRoute('payments-finish', [], ['force_canonical' => true]));
        $express->setCancelUrl($this->url()->fromRoute('payments-failure', [], ['force_canonical' => true]));
        
        
        
        // Do a request
        $response = $paypalRequest->send($express);
        
        // Check if we are using a sandbox
        $host = ( strpos($paypalRequest->getConfig()->getEndPoint(), 'sandbox') !== false ) ? 'sandbox.paypal' : 'paypal';

        // Redirect to Paypal!
        return $this->redirect()->toUrl(sprintf('https://www.%s.com/cgi-bin/webscr?cmd=_express-checkout&token=%s', $host, $response->getToken()));
    }

    /**
     * Finish
     * Finish after the payment
     *
     * @return ViewModel
     */
    public function finishAction()
    {
        // PayPal Request
        $paypalRequest = $this->getServiceLocator()->get('SpeckPaypal\Service\Request');

        // GetExpressCheckoutDetails
        $details = new \SpeckPaypal\Request\GetExpressCheckoutDetails(array(
            'token' => $this->params()->fromQuery('token')
        ));

        // Do a request
        $response = $paypalRequest->send($details);

        // Paypal PaymentItem
        $item = new \Payments\Model\PaymentsModel();
        $item = $item->findById(1);

        // Set the PaymentDetails (MaxCost of all Items)
        $paymentDetails = new \SpeckPaypal\Element\PaymentDetails([
            'amt' => $item->getAmt()
        ]);

        // Set the items
        $paymentDetails->setItems([ $item ]);

        // DoExpressCheckoutPayment
        $captureExpress = new \SpeckPaypal\Request\DoExpressCheckoutPayment([
            'token'             => $this->params()->fromQuery('token'),
            'payerId'           => $response->getPayerId(),
            'paymentDetails'    => $paymentDetails
        ]);

        $response = $paypalRequest->send($captureExpress);

        return new ViewModel([
            'transaction'   =>  $response
        ]);
    }

    /**
     * Failure
     * @return ViewModel
     */
    public function failureAction()
    {
        return new ViewModel([]);
    }

    /**
     * Read
     * @return void|ViewModel
     */
    public function readAction()
    {
        // TransactionSearch
        $transactionSearch  =   new \SpeckPaypal\Request\TransactionSearch();
        $transactionSearch->setTransactionId($this->params()->fromRoute('id'));
        $transactionSearch->setStartDate('2014-12-28T00:00:00Z');

        $paypalRequest      =   $this->getServiceLocator()->get('SpeckPaypal\Service\Request');
        $response           =   $paypalRequest->send($transactionSearch);

        // We can't find the transaction
        if( !($response->getResults()[0]) ) { $this->getResponse()->setStatusCode(404); return; }

        return new ViewModel([
            'transaction'   =>  $response->getResults()[0]
        ]);
    }

    public function updateAction() {}
    public function deleteAction() {}
}
