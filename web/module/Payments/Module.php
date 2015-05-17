<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Payments;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Db\ResultSet\ResultSet;
use Dashboard\Model\RadCheck;
use Dashboard\Model\RadCheckTable;
use Dashboard\Model\RadAcct;
use Dashboard\Model\RadAcctTable;
use Dashboard\Model\RadPostAuth;
use Dashboard\Model\RadPostAuthTable;
use Dashboard\Model\Users;
use Dashboard\Model\UsersTable;
use Dashboard\Model\UsersCode;
use Dashboard\Model\UsersCodeTable;
use Dashboard\Model\AppModule;
use Dashboard\Model\AppModuleTable;
use Dashboard\Model\AppOrders;
use Dashboard\Model\AppOrdersTable;
use Zend\Db\TableGateway\TableGateway;
use Zend\Validator\AbstractValidator;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Zend\Session\SessionManager' => function ($sm) {
                    $config = $sm->get('config');
                    if (isset($config['session'])) {
                        $session = $config['session'];

                        $sessionConfig = null;
                        if (isset($session['config'])) {
                            $class = isset($session['config']['class']) ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
                            $options = isset($session['config']['options']) ? $session['config']['options'] : array();
                            $sessionConfig = new $class();
                            $sessionConfig->setOptions($options);
                        }

                        $sessionStorage = null;
                        if (isset($session['storage'])) {
                            $class = $session['storage'];
                            $sessionStorage = new $class();
                        }

                        $sessionSaveHandler = null;
                        if (isset($session['save_handler'])) {
                            // class should be fetched from service manager since it will require constructor arguments
                            $sessionSaveHandler = $sm->get($session['save_handler']);
                        }

                        $sessionManager = new SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);
                    } else {
                        $sessionManager = new SessionManager();
                    }
                    Container::setDefaultManager($sessionManager);
                    return $sessionManager;
                },
                        'Dashboard\Model\UsersTable' => function($sm) {
                    $tableGateway = $sm->get('UsersTableGateway');
                    $table = new UsersTable($tableGateway);
                    return $table;
                },
                        'UsersTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Users());
                    return new TableGateway('app_users', $dbAdapter, null, $resultSetPrototype);
                },
                        'Dashboard\Model\UsersCodeTable' => function($sm) {
                    $tableGateway = $sm->get('UsersCodeTableGateway');
                    $table = new UsersCodeTable($tableGateway);
                    return $table;
                },
                        'UsersCodeTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resulSetPrototype = new ResultSet();
                    $resulSetPrototype->setArrayObjectPrototype(new UsersCode());
                    return new TableGateway('app_active_code', $dbAdapter, null, $resulSetPrototype);
                },
                        'Dashboard\Model\RadCheckTable' => function($sm) {
                    $tableGateway = $sm->get('RadCheckTableGateway');
                    $table = new RadCheckTable($tableGateway);
                    return $table;
                },
                        'RadCheckTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RadCheck());
                    return new TableGateway('radcheck', $dbAdapter, null, $resultSetPrototype);
                },
                        'Dashboard\Model\RadAcctTable' => function($sm) {
                    $tableGateway = $sm->get('RadAcctTableGateway');
                    $table = new RadAcctTable($tableGateway);
                    return $table;
                },
                        'RadAcctTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RadAcct());
                    return new TableGateway('radacct', $dbAdapter, null, $resultSetPrototype);
                },
                        'Dashboard\Model\RadPostAuthTable' => function($sm) {
                    $tableGateway = $sm->get('RadPostAuthTableGateway');
                    $table = new RadPostAuthTable($tableGateway);
                    return $table;
                },
                        'RadPostAuthTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RadPostAuth());
                    return new TableGateway('radpostauth', $dbAdapter, null, $resultSetPrototype);
                },
                        'Dashboard\Model\AppModuleTable' => function($sm) {
                    $tableGateway = $sm->get('AppModuleTableGateway');
                    $table = new AppModuleTable($tableGateway);
                    return $table;
                },
                        'AppModuleTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new AppModule());
                    return new TableGateway('app_modules', $dbAdapter, null, $resultSetPrototype);
                },
                        'Dashboard\Model\AppOrdersTable' => function($sm) {
                    $tableGateway = $sm->get('AppOrdersTableGateway');
                    $table = new AppOrdersTable($tableGateway);
                    return $table;
                },
                        'AppOrdersTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new AppOrders());
                    return new TableGateway('app_orders', $dbAdapter, null, $resultSetPrototype);
                },
                    ),
                );
            }

}
