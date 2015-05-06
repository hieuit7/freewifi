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

class IndexController extends AbstractActionController{
    //put your code here
    
    public function indexAction() {
      
        
        
        $User = new Container('user');
        $User->name = 'hieu';
        
        
        return new ViewModel();
    }
    public function flotAction(){
        return new ViewModel();
    }
    public function listAction(){
        return new ViewModel();
    }
}
