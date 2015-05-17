<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dashboard\Controller;

/**
 * Description of IndexController
 *
 * @author hieu
 */
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

//use Dashboard\Model\RadAcctTable;
//use Dashboard\Model\Users;



class IndexController extends AbstractActionController {

    //put your code here
    protected $radAcctTable;
    protected $radPostAuthTable;
    protected $appOrdersTable;
    protected $user;

    public function indexAction() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('Dashboard');
        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action' => 'index', 'urlLogin' => 'dashboard'));
        endif;
        $acct = $this->getRadAcctTable();
        $authens = $this->getRadPostAuthTable();
        $usersAuthen = $authens->getPostAuths('');
        $all = $acct->getAccts('', array(), 0);
        $inputs = 0;
        foreach ($all as $key => $value) {
            $inputs +=$value->getacctinputoctets();
        }
        $sums = array('userlogged' => $authens->count());
        $sums['bandwidthtrafic'] = $inputs;
        
        
        return new ViewModel(array(
            'sums' => $sums
        ));
    }

    public function bandwidthstatisticAction() {
        $k = $this->getRadAcctTable();
        $k = $k->fetchAll();
        return new ViewModel(
                array(
                'allUser'=>$k
            )
        );
    }

    public function userstatisticAction() {
        $k = $this->getRadAcctTable();
        $k = $k->fetchAll();
        return new ViewModel(
            array(
                'allUser'=>$k
            )
        );
    }

    public function paymentstatisticAction() {
        $k =$this->getAppOrdersTable();
        $k = $k->fetchAll();
        $user = $this->getUser();
        return new ViewModel(array(
            'transactions' => $k,
            'user'=>$user
        ));
    }

    public function getRadAcctTable() {
        if (!$this->radAcctTable):
            $sm = $this->getServiceLocator();
            $this->radAcctTable = $sm->get('Dashboard\Model\RadAcctTable');
        endif;

        return $this->radAcctTable;
    }

    public function getRadPostAuthTable() {
        if (!$this->radPostAuthTable):
            $sm = $this->getServiceLocator();
            $this->radPostAuthTable = $sm->get('Dashboard\Model\RadPostAuthTable');
        endif;

        return $this->radPostAuthTable;
    }
    
    public function getAppOrdersTable() {
        if (!$this->appOrdersTable):
            $sm = $this->getServiceLocator();
            $this->appOrdersTable = $sm->get('Dashboard\Model\AppOrdersTable');
        endif;
        return $this->appOrdersTable;
    }
    public function getUser() {
        if (!$this->user):
            $sm = $this->getServiceLocator();
            $this->user = $sm->get('Dashboard\Model\UsersTable');
        endif;
        return $this->user;
    }

}
