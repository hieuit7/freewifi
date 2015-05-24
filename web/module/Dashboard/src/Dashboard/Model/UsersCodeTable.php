<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dashboard\Model;

/**
 * Description of UsersCodeTable
 *
 * @author hieu
 */
use Zend\Db\TableGateway\TableGateway;
use Dashboard\Model\UsersCode;

use Dashboard\Model\Mapper\MapperTable;

class UsersCodeTable extends MapperTable{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
        parent::__construct($tableGateway);
    }

    public function getUsersCode($id) {
        $id = (string) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row):
            return false;
        endif;
        return $row;
    }
    public function getUsersCodeByName($name) {
        $name = (string) $name;
        $rowset = $this->tableGateway->select(array('username' => $name));
        $row = $rowset->current();
        if (!$row):
            return false;
            
        endif;
        return $row;
    }

    public function save(UsersCode $usersCode) {
        $data = array(
            'username' => $usersCode->getUsername(),
            'code' => $usersCode->getCode()
        );
        $id = (string) $usersCode->getId();
        if ($id == ''):
            $this->tableGateway->insert($data);
            return $this->tableGateway->getLastInsertValue();
        else:
            if($this->getUsersCode($id)):
                $this->tableGateway->update($data,array('id'=>$id));
            endif;
        endif;
    }
}
