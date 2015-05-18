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
use Zend\Session\Container;
use Dashboard\Model\AppProductCategories;
use Dashboard\Model\AppProductCategoriesTable;
use Dashboard\Model\AppProducts;
use Dashboard\Model\AppProductsTable;
use Dashboard\Model\RadAcctTable;

class PaymentsController extends AbstractActionController
{
    /**
     * Index
     * Overview of all the payments
     *
     * @return ViewModel
     */
    protected $user;
    protected $module;
    protected $appProductTable;
    protected $radAcctTable;
    public function indexAction()
    {
        $user = $this->getUser();
        $user = $user->fetchAll();
        $packet = $this->getAppProductsTable();
        $radact = $this->getRadAcctTable();
        return new ViewModel(array(
            'user'=>$user,
            'packet'=>$packet,
            'radact'=>$radact
        ));
    }
    public function createpaymentAction() {
        
        $order = $this->getRequest()->getContent();
        echo "<pre>";
        print_r($order);
        echo "</pre>";
        exit();
        return new ViewModel();
    }
    public function getUser() {
        if (!$this->user):
            $sm = $this->getServiceLocator();
            $this->user = $sm->get('Dashboard\Model\UsersTable');
        endif;
        return $this->user;
    }
    public function getModule(){
        if (!$this->module):
            $sm = $this->getServiceLocator();
            $this->module = $sm->get('Dashboard\Model\AppModuleTable');
        endif;
        return $this->module;
    }
    public function getAppProductsTable() {
        if (!$this->appProductTable):
            $sm = $this->getServiceLocator();
            $this->appProductTable = $sm->get('Dashboard\Model\AppProductsTable');
        endif;
        return $this->appProductTable;
    }
    public function getRadAcctTable() {
        if (!$this->radAcctTable):
            $sm = $this->getServiceLocator();
            $this->radAcctTable = $sm->get('Dashboard\Model\RadAcctTable');
        endif;

        return $this->radAcctTable;
    }
            
}
