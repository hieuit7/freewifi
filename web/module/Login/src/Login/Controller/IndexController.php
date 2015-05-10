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
use Login\Forms\LoginForms;

class IndexController extends AbstractActionController {

    public function indexAction() {

        $user = new Container('user');
        $form = new LoginForms();
        
        if (isset($user->name) && $user->name != 'guess'):
            $this->redirect()->toRoute('dashboard');
        endif;
        $request = $this->getRequest();
        $radCheck = new \Register\Model\RadCheck();
        if ($request->isPost()):
            $radCheck = new \Register\Model\RadCheck();
        endif;
        $this->layout('layout/login');
        
        
        return new ViewModel(array(
            'form' => $form
        ));
    }

}
