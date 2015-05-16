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

class AppModule implements InputFilterAwareInterface {
    
    protected $id;
    protected $name;
    protected $description;
    protected $attribute;
    protected $status;
    protected $created;
    protected $created_by;

    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getAttribute() {
        return $this->attribute;
    }
    public function getStatus() {
        return $this->status;
    }
    public function getCreated() {
        return $this->created;
    }
    public function getCreatedBy() {
        return $this->created_by;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setName($Name) {
        $this->name = $Name;
    }
    public function setDescription($Description) {
        $this->description = $Description;
    }
    public function setAttribute($Attribute) {
        $this->attribute = $Attribute;
    }
    public function setStatus($Status) {
        $this->status = $Status;
    }
    public function setCreated($Created) {
        $this->created = $Created;
    }
    public function setCreatedBy($CreatedBy) {
        $this->created_by = $CreatedBy;
    }
    
    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->attribute = (isset($data['attribute'])) ? $data['attribute'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->status = (isset($data['status'])) ? $data['status'] : null;
        $this->created = (isset($data['created'])) ? $data['created'] : null;
        $this->created_by = (isset($data['created_by'])) ? $data['created_by'] : null;
    }
    
    public function getInputFilter() {
        
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        
    }

}
