<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dashboard;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Mvc\ModuleRouteListener;
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
use Zend\Db\TableGateway\TableGateway;
use Zend\Validator\AbstractValidator;

class Module implements ConfigProviderInterface, AutoLoaderProviderInterface {

    public function onBootstrap($e) {
        $eventManager = $e->getApplication()->getEventManager();

        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $this->bootstrapSession($e);
        $this->onBootstrapTranslateForm($e);
    }

    public function onBootstrapTranslateForm($event) {
        $application = $event->getApplication();
        $serviceManager = $application->getServiceManager();
        $translator = $serviceManager->get('translator');
        // for validation
        AbstractValidator::setDefaultTranslator($translator, 'formvalidation');
        // for form element label and value
        $serviceManager->get('ViewHelperManager')
                ->get('formrow')
                ->setTranslatorTextDomain('formtranslate');
    }

    public function bootstrapLogin() {

        $user = new Container('user');
        if (isset($user->name) && $user->name == 'guess'):
            $url = $e->getRouter()->assemble(array(), array('name' => 'login'));
            $response = $e->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $url);
            $response->setStatusCode(302);
            $response->sendHeaders();
            $stopCallBack = function($event) use ($response) {
                $event->stopPropagation();
                return $response;
            };
            $e->getApplication()->getEventManager()->attach(MvcEvent::EVENT_ROUTE, $stopCallBack, -10000);
            return $response;
        endif;
    }

    public function bootstrapSession($e) {
        $session = $e->getApplication()
                ->getServiceManager()
                ->get('Zend\Session\SessionManager');
        $session->start();

        $container = new Container('initialized');
        if (!isset($container->init)) {
            $serviceManager = $e->getApplication()->getServiceManager();
            $request = $serviceManager->get('Request');

            $session->regenerateId(true);
            $container->init = 1;
            $container->remoteAddr = $request->getServer()->get('REMOTE_ADDR');
            $container->httpUserAgent = $request->getServer()->get('HTTP_USER_AGENT');

            $config = $serviceManager->get('Config');
            if (!isset($config['session'])) {
                return;
            }

            $sessionConfig = $config['session'];
            if (isset($sessionConfig['validators'])) {
                $chain = $session->getValidatorChain();

                foreach ($sessionConfig['validators'] as $validator) {
                    switch ($validator) {
                        case 'Zend\Session\Validator\HttpUserAgent':
                            $validator = new $validator($container->httpUserAgent);
                            break;
                        case 'Zend\Session\Validator\RemoteAddr':
                            $validator = new $validator($container->remoteAddr);
                            break;
                        default:
                            $validator = new $validator();
                    }

                    $chain->attach('session.validate', array($validator, 'isValid'));
                }
            }
        }
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
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
                    ),
                );
            }

        }
        