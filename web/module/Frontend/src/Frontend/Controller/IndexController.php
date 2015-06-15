<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Frontend\Controller;

/**
 * Description of IndexController
 *
 * @author hieu
 */
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Dashboard\Model\Users;
use Dashboard\Model\UsersCode;
use Dashboard\Model\UsersCodeTable;
use Dashboard\Model\RadCheck;
use Register\Forms\RegisterForms;
use Zend\Session\SessionManager;
use Dashboard\Model\AppProductCategories;
use Dashboard\Model\AppProductCategoriesTable;
use Dashboard\Model\AppProducts;
use Dashboard\Model\AppProductsTable;

class IndexController extends AbstractActionController {

    protected $usersTable;
    protected $usersCodeTable;
    protected $radCheckTable;
    protected $radAcctTable;
    protected $code;
    protected $urlLogin;
    protected $message;
    protected $appCategoryTable;

    public function __construct() {
        
    }

    public function getAppProductsTable() {
        if (!$this->appCategoryTable):
            $sm = $this->getServiceLocator();
            $this->appCategoryTable = $sm->get('Dashboard\Model\AppProductsTable');
        endif;
        return $this->appCategoryTable;
    }

    public function indexAction() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('Users');
        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action' => 'index', 'urlLogin' => 'users'));
        endif;

        $users = $this->getUsersTable();
        $items = $users->customGetData((int) $this->params()->fromQuery('page', 1), 1, array('username = \'' . $user->name . '\''), array(), array(), $page);

        if ($items):
            $OrderTable = $this->getServiceLocator()->get('Dashboard\Model\AppOrdersTable');
            $joins = array();
            $joins[] = array(
                'table' => 'app_order_details',
                'alias' => 'dt',
                'on' => 'a.orderid = dt.orderid',
                'columns' => array(
                    'product' => 'productid'  
                ),
                'type' => \Zend\Db\Sql\Select::JOIN_INNER
            );
            
            $orders = $OrderTable->customGetData(0, 0, array('customerid = \'' . $items[0]['id'] . '\''), array(), array(), $paging);
        endif;

        $page->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $page->setItemCountPerPage(10);

        $this->layout('layout/frontend');
        return new ViewModel(array(
            'items' => $items,
            'paginator' => $page
        ));
    }
    public function getUsersTable() {
        if (!$this->usersTable):
            $sm = $this->getServiceLocator();
            $this->usersTable = $sm->get('Dashboard\Model\UsersTable');
        endif;
        return $this->usersTable;
    }

    public function getRadCheckTable() {
        if (!$this->radCheckTable):
            $sm = $this->getServiceLocator();
            $this->radCheckTable = $sm->get('Dashboard\Model\RadAcctTable');
        endif;
        return $this->radCheckTable;
    }

    public function getRadAcctTable() {
        if (!$this->radAcctTable):
            $sm = $this->getServiceLocator();
            $this->radAcctTable = $sm->get('Dashboard\Model\RadAcctTable');
        endif;
        return $this->radAcctTable;
    }

    public function getUsersCodeTable() {
        if (!$this->usersCodeTable):
            $sm = $this->getServiceLocator();
            $this->usersCodeTable = $sm->get('Dashboard\Model\UsersCodeTable');
        endif;
        return $this->usersCodeTable;
    }

}
