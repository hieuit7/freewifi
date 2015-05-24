<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Dashboard\Model;

/*
 * 
 */
class RadPostAuth {
    
    protected $id;
    protected $username;
    protected $pass;
    protected $reply;
    protected $authdate;
    
    protected $_key = 'id';
    public function setKey($Key) {
        $this->_key = $Key;
    }
    public function getKey() {
        return $this->_key;
    }
    
    public function exchangeArray($data) {
        $this->id = (isset($data['id']))?$data['id']:'';
        $this->username = (isset($data['username']))?$data['username']:'';
        $this->pass = (isset($data['pass']))?$data['pass']:'';
        $this->reply = (isset($data['reply']))?$data['reply']:'';
        $this->authdate = (isset($data['authdate']))?$data['authdate']:'';
        
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function setPass($pass) {
        $this->pass = $pass;
    }
    public function setReply($reply) {
        $this->reply = $reply;
    }
    public function setAuthdate($authdate) {
        $this->authdate = $authdate;
    }
    public function getId() {
        return $this->id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getPass() {
        return $this->pass;
    }
    public function getReply() {
        return $this->reply;
    }
    public function getAuthdate() {
        return $this->authdate;
    }
    
    
}

