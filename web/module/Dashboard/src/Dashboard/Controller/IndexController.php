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
        $all = $acct->getAccts('',array(),0);
        $inputs = 0;
        foreach ($all as $key => $value) {
            $inputs +=$value->getacctinputoctets();
        }
        $sums = array('userlogged'=>$authens->count());
        $sums['bandwidthtrafic'] = $inputs;
        
        
        return new ViewModel(array(
            'sums' => $sums
        ));
    }

    public function bandwidthstatisticAction() {
        return new ViewModel();
    }

    public function userstatisticAction() {
        return new ViewModel();
    }

    public function paymentstatisticAction() {
        return new ViewModel();
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

}
