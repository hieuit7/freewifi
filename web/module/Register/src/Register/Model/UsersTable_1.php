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

namespace Register\Model;
use Register\Model\Users;
use Zend\Db\TableGateway\TableGateway;

class UsersTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getUser($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();

        if (!$row):
            throw new \Exception('Can\'t find user with ' . $id);
        endif;
        return $row;
    }
    
    public function find($username) {
        $rowSet = $this->tableGateway->select(array('username'=> $username));
        $row = $rowSet->current();
        if(!$row):
            throw new Exception('Can\'t find '.$username.'!!!!');
        endif;
        return $row;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function save(Users $users) {
        $data = array(
            'username' => $users->username,
            'password' => md5($users->password),
            'fullname' => $users->fullname,
            'email' => $users->email,
            'building' => $users->building,
            'phone' => $users->phone,
            'activate' => $users->activate,
            'room' => $users->room,
            'created' => $users->created,
            'created_by' => $users->created_by
        );
        $id = (int) $users->id;
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

}
