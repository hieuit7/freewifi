<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dashboard\Entity;

/**
 * Description of RadCheck
 *
 * @author hieu
 */
class RadCheck {
    protected $id;
    protected $username;
    protected $attribute;
    protected $op;
    protected $value;
    
    public function exchangeArray($data) {
        $this->id = (isset($data['id']))?$data['id']:null;
        $this->username = (isset($data['username']))?$data['username']:null;
        $this->attribute = (isset($data['attribute']))?$data['attribute']:null;
        $this->op = (isset($data['op']))?$data['op']:null;
        $this->value = (isset($data['value']))?$data['value']:null;        
    }
    
    public function setId($Id) {
        $this->id = $id;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function setAttribute($attribute) {
        $this->attribute = $attribute;
    }
    public function setOp($op) {
        $this->op = $op;
    }
    public function setValue($value) {
        $this->value = $value;
    }
    public function getId() {
        return $this->id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getAttribute() {
        return $this->attribute;
    }
    public function getOp() {
        return $this->op;
    }
    public function getValue() {
        return $this->value;
    }
}
