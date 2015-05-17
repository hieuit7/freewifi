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

class AppOrders implements InputFilterAwareInterface {
    
    protected $orderid;
    protected $customerid;
    protected $orderdate;
    protected $status;
    protected $sumtotal;
    protected $created_by;
    
    public function getOrderid() {
        return $this->orderid;
    }
    public function getCustomerid() {
        return $this->customerid;
    }
    public function getOrderdate() {
        return $this->orderdate;
    }
    public function getStatus() {
        return $this->status;
    }
    public function getSumtotal() {
        return $this->sumtotal;
    }
    public function getCreatedBy() {
        return $this->created_by;
    }
    
    
    public function exchangeArray($data) {
        $this->orderid = (isset($data['orderid'])) ? $data['orderid'] : null;
        $this->customerid = (isset($data['customerid'])) ? $data['customerid'] : null;
        $this->orderdate = (isset($data['orderdate'])) ? $data['orderdate'] : null;
        $this->status = (isset($data['status'])) ? $data['status'] : null;
        $this->sumtotal = (isset($data['sumtotal'])) ? $data['sumtotal'] : null;
        $this->created_by = (isset($data['created_by'])) ? $data['created_by'] : null;
    }
    
    public function getInputFilter() {
        
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        
    }

}
