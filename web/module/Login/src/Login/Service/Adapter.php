<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Login\Service;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

/**
 * Description of Authentication
 *
 * @author hieu
 */
class Apdapter implements AdapterInterface{
    //put your code here
    private $username;
    private $password;
    
    public function setUsername($username) {
        $this->username = $username;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function __construct() {
        ;
    }
    /**
     * 
     */
    public function authenticate() {
        
        
        
        $resule = array();
        $resule['code'] = Result::FAILURE;
        $resule['identity'] = NULL;
        $resule['message'] = array();
        
        
        
        
        $resule = new Result($code, $identity, $messages);
        
    }

}
