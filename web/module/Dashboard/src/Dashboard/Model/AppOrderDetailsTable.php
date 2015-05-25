<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dashboard\Model;

use Dashboard\Model\AppModule;
use Zend\Db\TableGateway\TableGateway;
use Dashboard\Model\Mapper\MapperTable;
use Dashboard\Model\AppOrderDetails;

class AppOrderDetailsTable extends MapperTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
        parent::__construct($tableGateway);
    }

    public function find($modulename) {
        $rowSet = $this->tableGateway->select(array('name' => $modulename));
        $row = $rowSet->current();
        if (!$row):
            return false;
        endif;
        return $row;
    }

    public function findById($id) {
        $rowSet = $this->tableGateway->select(array('orderid' => $id));
        $row = $rowSet->current();
        if (!$row):
            return false;
        endif;
        return $row;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        $result = array();
        while ($row = $resultSet->current()):
            $result[] = $row;
            $resultSet->next();
        endwhile;
        return $result;
    }

    public function save(AppOrderDetails $orderDetail) {
        $data = array(
            'orderid' => $orderDetail->getOrderid(),
            'productid' => $orderDetail->getProductid(),
            'unitprice' => $orderDetail->getUnitprice(),
            'quantity' => $orderDetail->getQuantity(),
            'discount' => $orderDetail->getDiscount(),
            'total' => $orderDetail->getTotal(),
        );
        $this->tableGateway->insert($data);
        return $this->tableGateway->getLastInsertValue();
    }

}
