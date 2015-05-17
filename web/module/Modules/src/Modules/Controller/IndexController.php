<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Controller;

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
use Dashboard\Model\AppModule;
use Dashboard\Model\AppModuleTable;
use Modules\Forms\ModulesForms;
use Zend\Session\SessionManager;


class IndexController extends AbstractActionController {

    protected $usersTable;
    protected $usersCodeTable;
    protected $radCheckTable;
    protected $appModuleTable;
    protected $code;
    protected $urlLogin;
    protected $message;
    protected $user;

    public function __construct() {
        
    }

    public function indexAction() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('MODULE_TITLE');
        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action' => 'login','urlLogin' => 'modules'));
        endif;
        $modules = $this->getAppModuleTable();
        $items = $modules->fetchAll();
//        echo "<pre>";
//        print_r($items);
//        echo "</pre>";
//        exit();
        
        $route = 'modules';
        return new ViewModel(array(
            'message' => $this->message,
            'buttons' => array(
                'add' => array(
                    'route' => $route,
                    'action' => 'add'
                ),
                'edit' => array(
                    'route' => $route,
                    'action' => 'edit'
                ),
                'delete' => array(
                    'route' => $route,
                    'action' => 'delete'
                )
            ),
            'items' => $items
        ));
    }

    public function addAction() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('MODULE_ADD_TITLE');
        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action' => 'login','urlLogin' => 'modules'));
        endif;
        $this->user = $user;
        $form = new ModulesForms();
        
        
        $request = $this->getRequest();
        
        if($request->isPost()):
            
            $form->setData($request->getPost());
            if($form->isValid()):
                $module = new AppModule();
                $module->exchangeArray($form->getData());
                $module->setCreated(date('Y-m-d H:m:s'));
                $module->setCreatedBy($this->user->id);
                $moduleTable = $this->getAppModuleTable();
                $id = $moduleTable->save($module);               
                if($id):
                    $this->redirect()->toRoute('modules');
                endif;
            endif;
            
        endif;
        
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function addUserAction(){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $module_attr = $_POST['module_attribute'];
        $check = $this->getRadCheckTable();
        $u = new RadCheck();
        $u->setUsername($username);
        $u->setAttribute($module_attr);
        $u->setValue($email);
        $u->setOp(':=');
        $check->save($u);
        $this->redirect()->toRoute('modules');
    }
    public function removeUserAction(){
        $radcheck_id = $_POST['radcheck_id'];
        $check = $this->getRadCheckTable();
        $check->removeCheck($radcheck_id);
        $this->redirect()->toRoute('modules');
    }
    
    public function listnguoidungAction(){
        $module_attr = $_POST['module_attribute'];
        $check = $this->getRadCheckTable();
        $check = $check->getCheckAttr($module_attr);
        $user = $this->getUser();
        return new ViewModel(array(
            'items' => $check,
            'user'=>$user
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
            $this->radCheckTable = $sm->get('Dashboard\Model\RadCheckTable');
        endif;
        return $this->radCheckTable;
    }
    public function getRadAcctTable() {
        if (!$this->radCheckTable):
            $sm = $this->getServiceLocator();
            $this->radCheckTable = $sm->get('Dashboard\Model\RadAcctTable');
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
    
    public function getAppModuleTable() {
        if (!$this->appModuleTable):
            $sm = $this->getServiceLocator();
            $this->appModuleTable = $sm->get('Dashboard\Model\AppModuleTable');
        endif;
        return $this->appModuleTable;
    }
    public function getUser() {
        if (!$this->user):
            $sm = $this->getServiceLocator();
            $this->user = $sm->get('Dashboard\Model\UsersTable');
        endif;
        return $this->user;
    }

}
