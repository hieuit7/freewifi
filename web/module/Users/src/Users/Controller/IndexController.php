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
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('Users');
        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action' => 'login', 'urlLogin' => 'users'));
        endif;

        $users = $this->getUsersTable();
        $items = $users->fetchAll();
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
            'items' => $items
        ));
    }

    public function addAction() {
        $form = new RegisterForms();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();

        if ($request->isPost()) {

            $users = new Users();

            $form->setInputFilter($users->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()):
                $users->exchangeArray($form->getData());

                $usersTable = $this->getUsersTable();
                if (!$usersTable->find($users->getUsername())):
                    $users->setActivate(0);
                    $users->setCreated(date('Y-m-d'));
                    $userId = $usersTable->save($users);
                    $codeActive = new \Zend\Captcha\Dumb();

                    $data = array(
                        'username' => $users->getUsername(),
                        'code' => $codeActive->generate()
                    );

                    $codeTable = $this->getUsersCodeTable();
                    $code = new UsersCode();
                    $code->exchangeArray($data);
                    $codeTable->save($code);
                    return $this->redirect()->toRoute('users');
                else:
                    $this->message = "User exist";
                endif;
            endif;
        }
        return new ViewModel(array(
            'form' => $form
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

    public function getUsersCodeTable() {
        if (!$this->usersCodeTable):
            $sm = $this->getServiceLocator();
            $this->usersCodeTable = $sm->get('Dashboard\Model\UsersCodeTable');
        endif;
        return $this->usersCodeTable;
    }

}
