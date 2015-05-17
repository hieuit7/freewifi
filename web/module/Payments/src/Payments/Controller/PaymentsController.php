<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Payments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class PaymentsController extends AbstractActionController
{
    /**
     * Index
     * Overview of all the payments
     *
     * @return ViewModel
     */
    protected $user;
    protected $module;
    public function indexAction()
    {
        $user = $this->getUser();
        $module = $this->getModule();
        return new ViewModel(array(
            'user'=>$user,
            'module'=>$module
        ));
    }
    public function getUser() {
        if (!$this->user):
            $sm = $this->getServiceLocator();
            $this->user = $sm->get('Dashboard\Model\UsersTable');
        endif;
        return $this->user;
    }
    public function getModule(){
        if (!$this->module):
            $sm = $this->getServiceLocator();
            $this->module = $sm->get('Dashboard\Model\AppModuleTable');
        endif;
        return $this->module;
    }
            
}
