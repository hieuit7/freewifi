<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Register\Controller;

/**
 * Description of IndexController
 *
 * @author hieu
 */
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Register\Model\Users;
use Register\Model\UsersCode;
use Register\Model\UsersCodeTable;
use Register\Forms\RegisterForms;
use Zend\Session\SessionManager;

class IndexController extends AbstractActionController {

    protected $usersTable;
    protected $usersCodeTable;
    protected $code;
    protected $urlLogin;

    public function __construct() {
//        $this->usersCodeTable = $this->getUsersCodeTable();
//        $this->usersTable = $this->getUsersTable();
    }
    public function setUrlLogin($url){
        $this->urlLogin = $url;
    }

    public function indexAction() {


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
                $users->active = '0';
                $users->created = date('Y-m-d');
                $userId = $usersTable->save($users);
                $codeActive = new \Zend\Captcha\Dumb();

                $data = array(
                    'username' => $users->username,
                    'code' => $codeActive->generate()
                );

                $codeTable = $this->getUsersCodeTable();
                $code = new UsersCode();
                $code->exchangeArray($data);
                $codeTable->save($code);

                return $this->redirect()->toRoute('register', array('action' => 'verify', 'id' => $userId));
            endif;
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function addAction() {
        return new ViewModel();
    }

    public function verifyAction() {
        $this->setUrlLogin('/');
        $request = $this->getRequest();
        $codeTable = $this->getUsersCodeTable();
        $id = $this->params('id');

        $userTable = $this->getUsersTable();
        if ($id):
            $user = $userTable->getUser($id);
        endif;
        if ($request->isPost()):
            $data = $request->getPost();
            if (isset($data['verify']) && isset($data['username'])):
                $code = $codeTable->getUsersCodeByName($data['username']);
                if (!$code):
                    return $this->redirect()->toRoute('register', array('action' => 'index'));
                endif;
                //check code 
                if ($code->getCode() == $data['verify']):
                    
                    return $this->redirect()->toUrl($this->urlLogin);
                endif;
            endif;
        else:
            $code = $codeTable->getUsersCodeByName($user->username);
        if($code == 'active'):
            return $this->redirect()->toUrl($this->urlLogin);
        endif;
            $data = array(
                'username' => $user->username,
                'code' => $code->getCode()
            );
            return new ViewModel($data);
        endif;
    }

    public function listAction() {
        return new ViewModel();
    }

    public function getUsersTable() {
        if (!$this->usersTable):
            $sm = $this->getServiceLocator();
            $this->usersTable = $sm->get('Register\Model\UsersTable');
        endif;
        return $this->usersTable;
    }

    public function getUsersCodeTable() {
        if (!$this->usersCodeTable):
            $sm = $this->getServiceLocator();
            $this->usersCodeTable = $sm->get('Register\Model\UsersCodeTable');
        endif;
        return $this->usersCodeTable;
    }

}
