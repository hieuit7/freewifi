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
use Dashboard\Model\AppProductCategories;
use Dashboard\Model\AppProductCategoriesTable;
use Dashboard\Model\AppProducts;
use Dashboard\Model\AppProductsTable;

class IndexController extends AbstractActionController {

    protected $usersTable;
    protected $usersCodeTable;
    protected $radCheckTable;
    protected $appModuleTable;
    protected $appProductTable;
    protected $appCategoryTable;
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
            $this->redirect()->toRoute('login', array('action' => 'login', 'urlLogin' => 'modules'));
        endif;
        $modules = $this->getAppModuleTable();
        $items = $modules->fetchAll();
        $user = $this->getUsersTable();
        $user = $user->fetchAll();
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
            'items' => $items,
            'user' => $user
        ));
    }

    public function addAction() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('MODULE_ADD_TITLE');
        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action' => 'login', 'urlLogin' => 'modules'));
        endif;
        $this->user = $user;
        $form = new ModulesForms();


        $request = $this->getRequest();

        if ($request->isPost()):

            $form->setData($request->getPost());
            if ($form->isValid()):
                $module = new AppModule();
                $module->exchangeArray($form->getData());
                $module->setCreated(date('Y-m-d H:m:s'));
                $module->setCreatedBy($this->user->id);
                $moduleTable = $this->getAppModuleTable();
                $id = $moduleTable->save($module);
                if ($id):
                    $this->redirect()->toRoute('modules');
                endif;
            endif;

        endif;


        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function editAction() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('MODULE_ADD_TITLE');
        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action' => 'login', 'urlLogin' => 'modules'));
        endif;
        $this->user = $user;
        $form = new ModulesForms();
        $modules = $this->getAppModuleTable();
        $id = $this->params('id', 0);
        
        $request = $this->getRequest();
        
        
        if ($request->isPost() && $request->getPost()->get('idsubmit', 0)):
            $para = $request->getPost();
            $form->setData($para);
            if ($form->isValid()):
                $module = new AppModule();
                $module->exchangeArray($form->getData());
                $module->setCreated(date('Y-m-d H:m:s'));
                $module->setCreatedBy($this->user->id);
                if($para->get('idsubmit',0)):
                    $module->setId($para->get('idsubmit',0));
                endif;
               
                $moduleTable = $this->getAppModuleTable();
                
                $id = $moduleTable->save($module);
                if ($id):
                    $this->redirect()->toRoute('modules');
                endif;
            endif;
        endif;

        if ($id):
            $module = $modules->findById($id);
            $form->setData(array(
                'name' => $module->getName(),
                'description' => $module->getDescription(),
                'attribute' => $module->getAttribute(),
                'status' => $module->getStatus()
            ));
        endif;

        return new ViewModel(
                array(
            'id' => $id,
            'form' => $form
        ));
    }
    public function delete() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('MODULE_ADD_TITLE');
        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action' => 'login', 'urlLogin' => 'modules'));
        endif;
        $this->user = $user;
        $form = new ModulesForms();
        $modules = $this->getAppModuleTable();
        $request = $this->getRequest();
        if($request->isPost()):
            $para = $request->getPost();
            $ids = $para->get('ids',0);
            if($ids):
                echo "<pre>";
                print_r($ids);
                echo "</pre>";
                exit();
            endif;
        endif;
        
        $request = $this->getRequest();
        $modules->delete($id);
    }
    public function addUserAction() {
        $id = $_POST['user_id'];
        $module_attr = $_POST['module_attribute'];
        $user = $this->getUsersTable();
        $u = $user->getUser($id);
        $email = $u->getEmail();
        $username = $u->getUsername();
        $check = $this->getRadCheckTable();
        $u = new RadCheck();
        $u->setUsername($username);
        $u->setAttribute($module_attr);
        $u->setValue($email);
        $u->setOp(':=');
        $check->save($u);
        $this->redirect()->toRoute('modules');
    }

    public function removeUserAction() {
        $radcheck_id = $_POST['radcheck_id'];
        $check = $this->getRadCheckTable();
        $check->removeCheck($radcheck_id);
        $this->redirect()->toRoute('modules');
    }

    public function packetAction() {
        $category = $this->getAppProductCategoriesTable();
        $route = 'modules';
        $packet = $this->getAppProductsTable();
        $packet = $packet->fetchAll();
        return new ViewModel(array(
            'buttons' => array(
                'add' => array(
                    'route' => $route,
                    'action' => 'addpacket'
                ),
                'edit' => array(
                    'route' => $route,
                    'action' => 'editpacket'
                ),
                'delete' => array(
                    'route' => $route,
                    'action' => 'deletepacket'
                )
            ),
            'items' => $packet,
            'category' => $category
                )
        );
    }

    public function categoryAction() {
        $route = 'modules';
        $category = $this->getAppProductCategoriesTable();
        $category = $category->fetchAll();
        return new ViewModel(array(
            'buttons' => array(
                'add' => array(
                    'route' => $route,
                    'action' => 'addcategory'
                ),
                'edit' => array(
                    'route' => $route,
                    'action' => 'editcategory'
                ),
                'delete' => array(
                    'route' => $route,
                    'action' => 'deletecategory'
                )
            ),
            'items' => $category
                )
        );
    }

    public function addpacketAction() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('MODULE_ADD_TITLE');
        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action' => 'login', 'urlLogin' => 'modules'));
        endif;
        $this->user = $user;
        $form = new ModulesForms();


        $request = $this->getRequest();

        if ($request->isPost()):

            $form->setData($request->getPost());
            if ($form->isValid()):
                $module = new AppModule();
                $module->exchangeArray($form->getData());
                $module->setCreated(date('Y-m-d H:m:s'));
                $module->setCreatedBy($this->user->id);
                $moduleTable = $this->getAppModuleTable();
                $id = $moduleTable->save($module);
                if ($id):
                    $this->redirect()->toRoute('modules');
                endif;
            endif;

        endif;

        $category = $this->getAppProductCategoriesTable();
        $category = $category->fetchAll();
        return new ViewModel(array(
            'form' => $form,
            'category' => $category
        ));
    }

    public function deletepacketAction() {
        $id = $_GET['id'];
        $user = $this->getAppProductsTable();
        $user->deleteUser($id);
        return $this->redirect()->toRoute('modules', array('action' => 'packet'));
    }

    public function deleteAllpacketAction() {
        $user = $this->getAppProductsTable();
        $user->deleteAllUser();
        return $this->redirect()->toRoute('modules', array('action' => 'packet'));
    }

    public function deletecategoryAction() {
        $id = $_GET['id'];
        $user = $this->getAppProductCategoriesTable();
        $user->deleteUser($id);
        return $this->redirect()->toRoute('modules', array('action' => 'category'));
    }

    public function deleteAllcategoryAction() {
        $user = $this->getAppProductCategoriesTable();
        $user->deleteAllUser();
        return $this->redirect()->toRoute('modules', array('action' => 'category'));
    }

    public function editcategoryAction() {
        $id = $_GET['id'];
        $user = $this->getAppProductCategoriesTable();
        $user = $user->findById($id);
        return new ViewModel(array(
            'category' => $user
        ));
    }

    public function editpacketAction() {
        $id = $_GET['id'];
        $user = $this->getAppProductsTable();
        $user = $user->findById($id);
        $category = $this->getAppProductCategoriesTable();
        $category = $category->fetchAll();
        return new ViewModel(array(
            'category' => $user,
            'category2' => $category
        ));
    }

    public function editpkAction() {
        $id = $_POST['id'];
        $category2 = $this->getAppProductsTable();
        $category2->deleteUser($id);
        $c = $this->getAppProductsTable();
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $unit = $_POST['unit'];
        $p = new AppProducts();
        $p->setName($name);
        $p->setCategory($category);
        $p->setPrice($price);
        $p->setUnit($unit);
        $c->save($p);
        return $this->redirect()->toRoute('modules', array('action' => 'packet'));
    }

    public function editctAction() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['id'];
        $category = $this->getAppProductCategoriesTable();
        $category->deleteUser($id);
        $c = new AppProductCategories();
        $c->setName($name);
        $c->setDescription($description);
        $category->save($c);
        return $this->redirect()->toRoute('modules', array('action' => 'category'));
    }

    public function addcategoryAction() {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        $renderer->headTitle('MODULE_ADD_TITLE');
        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess' || !isset($user->name)):
            $this->redirect()->toRoute('login', array('action' => 'login', 'urlLogin' => 'modules'));
        endif;
        $this->user = $user;
        $form = new ModulesForms();


        $request = $this->getRequest();

        if ($request->isPost()):

            $form->setData($request->getPost());
            if ($form->isValid()):
                $module = new AppModule();
                $module->exchangeArray($form->getData());
                $module->setCreated(date('Y-m-d H:m:s'));
                $module->setCreatedBy($this->user->id);
                $moduleTable = $this->getAppModuleTable();
                $id = $moduleTable->save($module);
                if ($id):
                    $this->redirect()->toRoute('modules');
                endif;
            endif;

        endif;


        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function addpkAction() {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $unit = $_POST['unit'];
        $pk = $this->getAppProductsTable();
        $p = new AppProducts();
        $p->setName($name);
        $p->setCategory($category);
        $p->setPrice($price);
        $p->setUnit($unit);
        $pk->save($p);
        return $this->redirect()->toRoute('modules', array('action' => 'packet'));
    }

    public function addctAction() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $pk = $this->getAppProductCategoriesTable();
        $p = new AppProductCategories();
        $p->setName($name);
        $p->setDescription($description);
        $p->setCreated(time());
        $p->setCreatedBy('Huy');
        $pk->save($p);
        return $this->redirect()->toRoute('modules', array('action' => 'category'));
    }

    public function listnguoidungAction() {
        $module_attr = $_POST['module_attribute'];
        $check = $this->getRadCheckTable();
        $check = $check->getCheckAttr($module_attr);
        $user = $this->getUser();
        return new ViewModel(array(
            'items' => $check,
            'user' => $user
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

    public function getAppProductsTable() {
        if (!$this->appProductTable):
            $sm = $this->getServiceLocator();
            $this->appProductTable = $sm->get('Dashboard\Model\AppProductsTable');
        endif;
        return $this->appProductTable;
    }

    public function getAppProductCategoriesTable() {
        if (!$this->appCategoryTable):
            $sm = $this->getServiceLocator();
            $this->appCategoryTable = $sm->get('Dashboard\Model\AppProductCategoriesTable');
        endif;
        return $this->appCategoryTable;
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
