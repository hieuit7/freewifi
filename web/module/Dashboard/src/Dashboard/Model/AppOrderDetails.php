<?php

namespace Dashboard\Model;




class AppOrderDetails
{
    private $orderid;
    private $_key = 'orderid';
    private $productid;
    private $unitprice = '0.00';
    private $quantity = '1';
    private $discount = '0';

    private $total;
    
    public function getTotal() {
        return $this->total;
    }
    public function getDiscount() {
        return $this->discount;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function getUnitprice() {
        return $this->unitprice;
    }
    public function getProductid() {
        return $this->productid;
    }
    public function getOrderid() {
        return $this->orderid;
    }
    
    public function setTotal($Total) {
        $this->total = $Total;
    }
    public function setDiscount($Discount) {
        $this->discount = $Discount;
    }
    
    public function setQuantity($Quantity) {
        $this->quantity = $Quantity;
    }
    public function setUnitprice($Unitprice) {
        $this->unitprice = $Unitprice;
    }
    public function setProductid($Productid) {
        $this->productid = $Productid;
    }
    public function setOderid($Oderid) {
        $this->orderid = $Oderid;
    }
    
    public function exchangeArray($data) {
        $this->orderid = (isset($data['orderid'])) ? $data['orderid'] : null;
        $this->productid = (isset($data['productid'])) ? $data['productid'] : null;
        $this->quantity = (isset($data['quantity'])) ? $data['quantity'] : null;
        $this->unitprice = (isset($data['unitprice'])) ? $data['unitprice'] : null;
        $this->discount = (isset($data['discount'])) ? $data['discount'] : null;
        $this->total = (isset($data['total'])) ? $data['total'] : null;
    }
}
