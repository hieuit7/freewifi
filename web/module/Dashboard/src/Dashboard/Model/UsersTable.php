<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersTable
 *
 * @author hieu
 */

namespace Dashboard\Model;

use Dashboard\Model\Users;
use Zend\Db\TableGateway\TableGateway;
use Dashboard\Model\Mapper\MapperTable;

class UsersTable extends MapperTable{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getUser($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();

        if (!$row):
            return false;
        endif;
        return $row;
    }
    
    public function find($username,$options = array()) {
        $wheres = array();
        if(isset($username)):
            $wheres['username'] = $username;
        else:
            throw new Exception('Username is not empty!!');
        endif;
        if($options):
            foreach ($options as $key => $value) {
                $wheres[$key] = $value;
            }
        endif;
        $rowSet = $this->tableGateway->select($wheres);
        $row = $rowSet->current();
        if(!$row):
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

    public function save(Users $users) {
        $data = array(
            'username' => $users->getUsername(),
            'password' => md5($users->getPassword()),
            'fullname' => $users->getFullname(),
            'email' => $users->getEmail(),
            'building' => $users->getBuilding(),
            'phone' => $users->getPhone(),
            'activate' => $users->getActivate(),
            'room' => $users->getRoom(),
            'created' => $users->getCreated(),
            'created_by' => $users->getCreatedBy()
        );
        $id = (int) $users->getId();
        if ($id == 0):
            $this->tableGateway->insert($data);
            return $this->tableGateway->getLastInsertValue();
        else:
            if ($this->getUser($id)):
                $this->tableGateway->update($data, array('id' => $id));
            else:
                throw new \Exception('User '.$id.' doesn\'t exists!!!');
            endif;
        endif;
    }
    
    public function deleteUser($id) {
        $this->tableGateway->delete(array('id'=>(int)$id));
    }
    public function deleteAllUser() {
        $this->tableGateway->delete();
    }

}
