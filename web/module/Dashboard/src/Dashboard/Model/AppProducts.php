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

class AppProducts implements InputFilterAwareInterface {
    
    protected $id;
    protected $name;
    protected $category;
    protected $price;
    protected $unit;
    protected $created;
    protected $created_by;
    
    public function setId($Id) {
        $this->id = $Id;
    }
    public function setName($Name) {
        $this->name = $Name;
    }
    public function setPrice($Price) {
        $this->price = $Price;
    }
    public function setCategory($Category) {
        $this->category = $Category;
    }
    public function setUnit($Unit) {
        $this->unit = $Unit;
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
    public function getCategory() {
        return $this->category;
    }
    public function getUnit() {
        return $this->unit;
    }
    public function getPrice() {
        return $this->price;
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
        $this->category = (isset($data['category'])) ? $data['category'] : null;
        $this->price = (isset($data['price'])) ? $data['price'] : null;
        $this->unit = (isset($data['unit'])) ? $data['unit'] : null;
        $this->created = (isset($data['created'])) ? $data['created'] : null;
        $this->created_by = (isset($data['created_by'])) ? $data['created_by'] : null;
    }
    
    public function getInputFilter() {
        
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        
    }

}
