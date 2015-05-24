<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Dashboard\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class AppProductCategories implements InputFilterAwareInterface {
    
    protected $id;
    protected $name;
    protected $value;
    protected $description;
    protected $created;
    protected $created_by;
    
    protected $_key = 'id';
    public function setKey($Key) {
        $this->_key = $Key;
    }
    public function getKey() {
        return $this->_key;
    }
    
    public function setValue($Value) {
        $this->value = $Value;
    }
    public function getValue() {
        return $this->value;
    }
    public function setId($Id) {
        $this->id = $Id;
    }
    public function setName($Name) {
        $this->name = $Name;
    }
    public function setDescription($Description) {
        $this->description = $Description;
    }
    public function setCreated($Created) {
        $this->created = $Created;
    }
    public function setCreatedBy($CreatedBy) {
        $this->created_by = $CreatedBy;
    }
    
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getCreated() {
        return $this->created;
    }
    public function getCreatedBy() {
        return $this->created_by;
    }
    
    
    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->value = (isset($data['value'])) ? $data['value'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->created = (isset($data['created'])) ? $data['created'] : null;
        $this->created_by = (isset($data['created_by'])) ? $data['created_by'] : null;
    }
    
    public function getInputFilter() {
        
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        
    }

}
