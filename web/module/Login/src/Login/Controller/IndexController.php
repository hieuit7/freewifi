<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author myhoang
 */
namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController{
    //put your code here
    
    public function indexAction() {
        
        //$view->setTemplate('layout/layout');
        $this->layout('layout/login');
        return new ViewModel();
    }
    
}
