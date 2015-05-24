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
class AppOrdersTable extends MapperTable{

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
        $rowSet = $this->tableGateway->select(array('id' => $id));
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

    public function save(AppModule $module) {
        $data = array(
            'name' => $module->getName(),
            'description' => $module->getDescription(),
            'attribute' => $module->getAttribute(),
            'status' => $module->getStatus(),
            'created' => $module->getCreated(),
            'created_by' => $module->getCreatedBy()
        );
        $id = (int) $module->getId();
        if ($id == 0):
            $this->tableGateway->insert($data);
            return $this->tableGateway->getLastInsertValue();
        else:
            if ($this->findById($id)):
                $this->tableGateway->update($data, array('id' => $id));
                return $id;
            else:
                return false;
            endif;
        endif;
    }

}
