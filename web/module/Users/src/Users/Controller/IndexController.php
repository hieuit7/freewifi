<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Users\Controller;

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
        $items = $users->customGetData((int) $this->params()->fromQuery('page', 1), 10, array(), array(), array(), $page);
        $page->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $page->setItemCountPerPage(10);
        //$items = $users->fetchAll();
        //do with payment

        $route = 'user-action';
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
            'items' => $items,
            'paginator' => $page
        ));
    }

    public function addAction() {
        $form = new RegisterForms(null, array(), $this->getServiceLocator());
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $users = new Users();
            $form->setInputFilter($users->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()):
                $data = $form->getData();
                if (!isset($data['activate'])):
                    $data['activate'] = 1;
                endif;
                if (!isset($data['created'])):
                    $data['created'] = date('Y-m-d H:i:s');
                endif;
                if (!isset($data['created_by'])):
                    $data['created_by'] = 1;
                endif;
                $users->exchangeArray($data);
                $userTable = $this->getUsersTable();
                $id = $userTable->save($users);
                if ($id):
                    $this->flashMessenger("User created!!");

                    $this->redirect()->toRoute('users', array('action' => 'index'));
                endif;
            endif;
        }
        return new ViewModel(array(
            'form' => $form,
            'message' => $form->getMessages()
        ));
    }

    public function editAction() {
        $id = $this->getEvent()->getRouteMatch()->getParam('id', '');
        if ($id):
            $userTable = $this->getUsersTable();
            $user = $userTable->getUser($id);
            $form = new RegisterForms(null, array(), $this->getServiceLocator());
            $form->setData(array(
                'username' => $user->getUsername(),
                'fullname' => $user->getFullname(),
                'password' => $user->getPassword(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
                'packet' => $user->getPacket(),
                'building' => $user->getBuilding(),
                'room' => $user->getRoom(),
                'activate' => $user->getActivate()
            ));
        else:

        endif;
        return new ViewModel(array(
            'data' => array(
                'id' => $user->getId(),
                'created' => $user->getCreated(),
                'created_by' => $user->getCreatedBy(),
            ),
            'form' => $form
        ));
    }

    public function saveAction() {
        $form = new RegisterForms(null, array(), $this->getServiceLocator());
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $users = new Users();
            $form->setInputFilter($users->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()):
                $data = $form->getData();
                if ($request->getPost()->get('id')):
                    $data['id'] = $request->getPost()->get('id');
                //$this->redirect()->toRoute('users', array('action' => 'edit','id'=>$request->getPost()->get('id')));
                endif;
                foreach ($data as $key => $d) :
                    if (!$d):
                        unset($data[$key]);
                    endif;
                endforeach;
                if (!isset($data['activate'])):
                    $data['activate'] = 1;
                endif;
                if (!isset($data['created'])):
                    $data['created'] = date('Y-m-d H:i:s');
                endif;
                if (!isset($data['created_by'])):
                    $data['created_by'] = 1;
                endif;
                $users->exchangeArray($data);
                $userTable = $this->getUsersTable();
                $id = $userTable->save($users);

                if ($id):
                    $this->flashMessenger("User created!!");
                    $this->redirect()->toRoute('users', array('action' => 'index'));
                endif;
            else:
                if ($request->getPost()->get('id')):
                    //$data['id'] = $request->getPost()->get('id');
                    $this->redirect()->toRoute('users', array('action' => 'edit', 'id' => $request->getPost()->get('id')));
                endif;
                $this->redirect()->toRoute('users', array('action' => 'ADD',));
            endif;
        }
        $this->redirect()->toRoute('users', array('action' => 'index'));
    }

    public function deleteAction() {
        $id = $this->getEvent()->getRouteMatch()->getParam('id', '');
        if ($id):
            $this->getUsersTable()->deleteUser($id);
            $this->redirect()->toRoute('users', array('action' => 'index'));
        else:
            $this->redirect()->toRoute('users', array('action' => 'index'));
        endif;
    }

    public function deactiveAction() {
        $request = $this->getRequest();
        if ($request->isPost()):
            $postData = $request->getPost();
            $type = $postData->get('type');
            $id = $postData->get('id');
            if ($id && $type):
                $userTable = $this->getUsersTable();
                $user = $userTable->getUser($id);
               
                if ($user && $type == 'active'):
                    $user->setActivate(1);
                echo 1;
                elseif ($user && $type != 'active'):
                    $user->setActivate(0);
                echo 2;
                endif;
                $userTable->save($user);
                
                exit;
            endif;
            echo 0;
            exit;

        endif;
        echo 0;
        exit;
    }

    public function deleteAllAction() {
        $user = $this->getUsersTable();
        $user->deleteAllUser();
        return $this->redirect()->toRoute('users');
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
