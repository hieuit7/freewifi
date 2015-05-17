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

    public function setUrlLogin($url) {
        $this->urlLogin = $url;
    }

    public function indexAction() {
        $User = new Container('user');
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
                    return $this->redirect()->toRoute('register', array('action' => 'verify', 'id' => $userId));
                else:
                    $this->message = "User exist";
                endif;
            endif;
        }
        $this->layout('layout/register');
        return new ViewModel(array(
            'form' => $form,
            'message' => $this->message
        ));
    }

    public function addAction() {
        return new ViewModel();
    }

    public function verifyAction() {
        $drad = new RadCheck();
        $this->setUrlLogin('/');
        $request = $this->getRequest();
        $codeTable = $this->getUsersCodeTable();
        $radCheckTable = $this->getRadCheckTable();
        $userTable = $this->getUsersTable();
        $id = $this->params('id', 0);
        if ($id):
            $user = $userTable->getUser($id);
            $code = $codeTable->getUsersCodeByName($user->getUsername());
            if ($code->getCode() == 'active'):
                return $this->redirect()->toUrl($this->urlLogin);
            endif;
        endif;
        if ($request->isPost()):
            $data = $request->getPost();

            if (isset($data['verify']) && isset($data['username'])):
                $code = $codeTable->getUsersCodeByName($data['username']);

                if (!$code):
                    // error message!!!
                    return $this->redirect()->toRoute('register', array('action' => 'index'));
                endif;
                //check code

                if ($code->getCode() == $data['verify']):
                    $userInsert = $userTable->find($data['username']);
                    $radCheckTable = $this->getRadCheckTable();
                    $userCheck = $radCheckTable->getChecks($userInsert->getUsername(), array('attribute' => 'Md5-Password'));
                    if ($userInsert && count($userCheck) > 0):

                        $data = array(
                            'username' => $userInsert->getUsername(),
                            'attribute' => 'Md5-Password',
                            'op' => ':=',
                            'value' => $userInsert->getPassword()
                        );
                        $radData = new RadCheck();
                        $radData->exchangeArray($data);

                        $radCheckTable = $this->getRadCheckTable();
                        $radSave = $radCheckTable->save($radData);

                        if ($radSave):
                            $code->setCode('active');
                            $codeTable->save($code);
                            return $this->redirect()->toUrl($this->urlLogin);
                        endif;
                    else:
                        $this->message = 'User exist!!';
                        return $this->redirect()->toUrl($this->urlLogin);
                    endif;
                    
                endif;

            endif;
        else:
            $code = $codeTable->getUsersCodeByName($user->getUsername());
            if ($code == 'active'):
                return $this->redirect()->toUrl($this->urlLogin);
            endif;
            $data = array(
                'username' => $user->getUsername(),
                'code' => $code->getCode(),
                'id' => $id,
                'message' => $this->message
            );
            $this->layout('layout/register');
            return new ViewModel($data);
        endif;
    }
    public function autoAction() {
        
        return new ViewModel();
    }
    
    public function listAction() {
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
