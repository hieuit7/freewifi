<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Payment\Controller;

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

class IndexController extends AbstractActionController {

    protected $usersTable;
    protected $usersCodeTable;
    protected $radCheckTable;
    protected $code;
    protected $urlLogin;
    protected $message;

    public function __construct() {
        
    }

    public function indexAction() {        
        return new ViewModel();
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
            $this->radCheckTable = $sm->get('Dashboard\Model\RadCheckTable');
        endif;
        return $this->radCheckTable;
    }

    public function getUsersCodeTable() {
        if (!$this->usersCodeTable):
            $sm = $this->getServiceLocator();
            $this->usersCodeTable = $sm->get('Dashboard\Model\UsersCodeTable');
        endif;
        return $this->usersCodeTable;
    }

}
