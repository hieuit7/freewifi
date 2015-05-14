<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RadAcctTable
 *
 * @author hieun_000
 */

namespace Dashboard\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Dashboard\Model\RadPostAuth;

class RadPostAuthTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getPostAuth($id) {
        $id = (string) $id;
        $resultSet = $this->tableGateway->select(array('radacctid' => $id));
        $row = $resultSet->current();
        if (!$row):
            throw new Exception('Can\'t find id ' . $id);
        endif;
        return $row;
    }

    public function getPostAuths($username, $wheres = array(),$limit = null) {
        $select  = new Select('radpostauth');
        if (isset($username) && $username !== ''):
            $select->where(array('username' =>  $username));
        endif;
        if($wheres):
            $select->where($wheres);
        endif;
        if($limit):
            $select->limit($limit);
        endif;
        $resultSet = $this->tableGateway->selectWith($select);
        $result = array();
        
        while ($row = $resultSet->current()):
            $result[] = $row;
            $resultSet->next();
        endwhile;
        return $result;
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
    public function count() {
        return $this->tableGateway->select()->count();        
    }
    public function save(RadPostAuth $radacct) {
        $data = array(
            'username' => $radacct->getUsername(),
            'pass' => $radacct->getPass(),
            'reply' => $radacct->getReply(),
            'authdate' => $radacct->getAuthdate()
        );
        $id = (string) $radacct->getradacctionid();
        if ($id != ''):
            $this->tableGateway->update($data);
        else:
            $id = $this->tableGateway->insert($data);
        endif;
        return $id;
    }

}
