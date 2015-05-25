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
use Dashboard\Model\AppOrders;
use Dashboard\Model\AppOrderDetails;

class PaymentsController extends AbstractActionController {

    /**
     * Index
     * Overview of all the payments
     *
     * @return ViewModel
     */
    protected $userTable;
    protected $module;
    protected $appProductTable;
    protected $radAcctTable;
    protected $appOrdersTable;
    protected $appOrderDetailsTable;

    public function indexAction() {
        $userTable = $this->getUserTable();
        //$radact = $this->getRadAcctTable();
        $wheres = $joins = $orders = array();

        $joins[] = array(
            'table' => 'app_products',
            'alias' => 'pr',
            'columns' => array(
                'products_name' => 'name',
                'price' => 'price',
                'unit' => 'unit',
                'value' => 'value'
            ),
            'on' => 'a.packet = pr.id',
            'type' => \Zend\Db\Sql\Select::JOIN_INNER
        );
        $usersPay = $userTable->customGetData('', 0, array('a.activate = 1'), array(), $joins, $page);
        $ordersTable = $this->getAppOrdersTable();
        //$ordersTable->fetchAll();
        $date = date('m-Y');

        foreach ($usersPay as $user):
            $order = $ordersTable->search(array(
                'customerid = ' . $user['id'],
                'date_format(date(orderdate),\'%m-%Y\') = \'' . $date . '\''
            ));
            if (count($order) <= 0):
            
                $orobj = new AppOrders();
                $orobj->setCustomerid($user['id']);
                $orobj->setOrderdate(date('Y-m-d H:m:s'));
                $orobj->setStatus(0);
                $orobj->setSumtotal($user['price']);
                $ordersCreated = array();
                $id = $ordersTable->save($orobj);

                if ($id):                    
                    $orderDataDetail = new AppOrderDetails();
                    $orderDataDetail->setOderid($id);
                    $orderDataDetail->setProductid($user['packet']);
                    $orderDataDetail->setQuantity('1');
                    $orderDataDetail->setUnitprice($user['price']);
                    $orderDataDetail->setTotal($orderDataDetail->getQuantity() * $orderDataDetail->getUnitprice());
                    $appOrderDetals = $this->getAppOrderDetailsTable();
                    $idd = $appOrderDetals->save($orderDataDetail);
                    $ordersCreated[] = $idd;
                endif;
            endif;
        endforeach;
        $joins = array();
        $joins[] = array(
          'table' => 'app_order_details'  ,
            'alias' => 'od',
            'columns' =>array('productid'=>'productid'),
            'on' => 'a.orderid = od.orderid',
            'type' => \Zend\Db\Sql\Select::JOIN_INNER
        );
        $joins[] = array(
          'table' => 'app_users'  ,
            'alias' => 'u',
            'columns' =>array('username'=>'username'),
            'on' => 'a.customerid = u.id',
            'type' => \Zend\Db\Sql\Select::JOIN_LEFT
        );
        $items = $ordersTable->customGetData('',0,array(),array(),$joins,$paging);
        
        return new ViewModel(array(
            'items' => $items
        ));
    }

    public function createpaymentAction() {

        $order = $this->getRequest()->getPost();
        $user = $this->getUser()->getUser($order->get('id_user'));
        $radAcct = $this->getRadAcctTable();
        $username = $radAcct->findByUsername($order->get('radcheck_id'));
        $packet = $this->getAppProductCategoriesTable();
        $packetvalue = $packet->findById($user->getPacket());
        $time = 0;
        $bw = 0;
        foreach ($username as $key => $value) {
            
        }

        return new ViewModel();
    }

    public function getUserTable() {
        if (!$this->userTable):
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Dashboard\Model\UsersTable');
        endif;
        return $this->userTable;
    }

    public function getModule() {
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

    public function getAppProductCategoriesTable() {
        if (!$this->appProductTable):
            $sm = $this->getServiceLocator();
            $this->appProductTable = $sm->get('Dashboard\Model\AppProductCategoriesTable');
        endif;
        return $this->appProductTable;
    }

    public function getAppOrdersTable() {
        if (!$this->appOrdersTable):
            $sm = $this->getServiceLocator();
            $this->appOrdersTable = $sm->get('Dashboard\Model\AppOrdersTable');
        endif;
        return $this->appOrdersTable;
    }

    public function getAppOrderDetailsTable() {
        if (!$this->appOrderDetailsTable):
            $sm = $this->getServiceLocator();
            $this->appOrderDetailsTable = $sm->get('Dashboard\Model\AppOrderDetailsTable');
        endif;
        return $this->appOrderDetailsTable;
    }

}
