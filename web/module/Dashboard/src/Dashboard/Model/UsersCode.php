<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersCode
 *
 * @author hieu
 */

namespace Dashboard\Model;

class UsersCode {

    protected $id;
    protected $username;
    protected $code;
    
    protected $_key = 'id';
    public function setKey($Key) {
        $this->_key = $Key;
    }
    public function getKey() {
        return $this->_key;
    }

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->code = (isset($data['code'])) ? $data['code'] : null;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($Username) {
        $this->username = $Username;
    }

    public function setCode($Code) {
        $this->code = $Code;
    }
    
    public function getId() {
        return $this->id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getCode() {
        return $this->code;
    }
    
    
}
