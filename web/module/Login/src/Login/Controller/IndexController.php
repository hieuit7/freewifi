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
use Login\Forms\LoginInputFilter;
use Dashboard\Model\RadCheckTable;

class IndexController extends AbstractActionController {

    protected $radCheckTable;

    public function indexAction() {

        $routedUrl = $this->params('urlLogin');
        $user = new Container('user');
        $form = new LoginForms();


        if (isset($user->name) && $user->name != 'guess'):
            $this->redirect()->toRoute($routedUrl);
        endif;

        $request = $this->getRequest();

        if ($request->isPost()):
            $loginFilter = new LoginInputFilter();
            $form->setInputFilter($loginFilter);
            $form->setData($request->getPost());

            if ($form->isValid()):
                $data = $form->getData();
                $radCheckTable = $this->getRadCheckTable();
                $result = $radCheckTable->getChecks($data['username'], array('attribute' => 'Md5-Password', 'value' => md5($data['password'])));
                if (!$result):
                    $userTalbe = $this->getAppUsers();
                    $result = $userTalbe->find($data['username'], array('password' => md5($data['password'])));
                    if ($result):
                        $appUser = (isset($result)) ? $result : new Dashboard\Model\Users();
                        if (($appUser->getUsername()) == $data['username']):
                            $user->name = $appUser->getUsername();
                            $user->id = $appUser->getId();
                            $this->redirect()->toRoute($routedUrl);
                        endif;
                    endif;
                else:
                    if ($result && count($result) > 0):
                        $radCheck = (isset($result[0]) ? $result[0] : new \Dashboard\Model\RadCheck());
                        if (($radCheck->getUsername() == $data['username'])):
                            $appUserTable = $this->getAppUsers();
                            $user->name = $radCheck->getUsername();
                            $appUser = $appUserTable->find($user->name);
                            if ($appUser):
                                $user->id = $appUser->getId();
                            endif;
                            $this->redirect()->toRoute($routedUrl);
                        endif;
                    endif;
                endif;

            endif;
        //$radCheckTable->getChecks($name, $options);
        endif;
        $this->layout('layout/login');
        return new ViewModel(array(
            'form' => $form,
            'urlLogin' => $routedUrl
        ));
    }

    function logoutAction() {
        $urlLogin = $this->params('urlLogin');
        $user = new Container('user');
        if (isset($user->name) && $user->name != 'guess'):
            $user->name = 'guess';
            $this->redirect()->toRoute('login', array('urlLogin' => $urlLogin));
        endif;
        $this->redirect()->toRoute('login', array('action' => 'index', 'urlLogin' => 'dashboard'));
    }

    public function getRadCheckTable() {
        if (!$this->radCheckTable):
            $sm = $this->getServiceLocator();
            $this->radCheckTable = $sm->get('Dashboard\Model\RadCheckTable');
        endif;
        return $this->radCheckTable;
    }

    public function getAppUsers() {
        $sm = $this->getServiceLocator();
        $appUsersTable = $sm->get('Dashboard\Model\UsersTable');
        return $appUsersTable;
    }

}
