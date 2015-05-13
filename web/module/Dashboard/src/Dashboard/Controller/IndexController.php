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



class IndexController extends AbstractActionController{
    //put your code here
    protected $radAcctTable;
    public function indexAction() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('Dashboard');
        $user = new Container('user');
        if(isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action'=>'index','urlLogin'=>'dashboard'));
        endif;
        $acct = $this->getRadAcctTable();
        $all = $acct->fetchAll();
        $sums = array();
        foreach ($all as $value):
            
        endforeach;
        
        return new ViewModel(array(
            
        ));
    }
    public function bandwidthstatisticAction(){
        return new ViewModel();
    }
    public function userstatisticAction(){
        return new ViewModel();
    }
    public function paymentstatisticAction(){
        return new ViewModel();
    }
    
    public function getRadAcctTable() {
        if (!$this->radAcctTable):
            $sm = $this->getServiceLocator();
            $this->radAcctTable = $sm->get('Dashboard\Model\RadAcctTable');
        endif;
        
        return $this->radAcctTable;
    }
    
}
