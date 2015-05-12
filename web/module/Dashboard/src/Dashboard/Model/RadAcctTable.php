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
use DashBoard\Model\RadAcct;

class RadAcctTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getAcct($id) {
        $id = (string) $id;
        $resultSet = $this->tableGateway->select(array('radacctid' => $id));
        $row = $resultSet->current();
        if (!$row):
            throw new Exception('Can\'t find id ' . $id);
        endif;
        return $row;
    }

    public function getAccts($username, $options = array()) {
        $wheres = array();
        if (isset($username)):
            $wheres[] = 'username = \'' . $username . '\'';
        endif;
        foreach ($options as $key => $value) {
            $wheres[] = $key . ' = \'' . $value . '\'';
        };
        $resultSet = $this->tableGateway->select($wheres);
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

    public function save(RadAcct $radacct) {
        $data = array(
            'acctsessionid' => $radacct->getradacctionid(),
            'acctuniqueid' => $radacct->getradacctionid(),
            'username' => $radacct->getradacctionid(),
            'groupname' => $radacct->getradacctionid(),
            'realm' => $radacct->getradacctionid(),
            'nasipaddress' => $radacct->getradacctionid(),
            'nasporttype' => $radacct->getradacctionid(),
            'acctstarttime' => $radacct->getradacctionid(),
            'acctupdatetime' => $radacct->getradacctionid(),
            'acctstoptime' => $radacct->getradacctionid(),
            'acctinterval' => $radacct->getradacctionid(),
            'acctsessiontime' => $radacct->getradacctionid(),
            'acctauthentic' => $radacct->getradacctionid(),
            'connectinfo_start' => $radacct->getradacctionid(),
            'connectinfo_stop' => $radacct->getradacctionid(),
            'acctinputoctets' => $radacct->getradacctionid(),
            'acctoutputoctets' => $radacct->getradacctionid(),
            'calledstationid' => $radacct->getradacctionid(),
            'callingstationid' => $radacct->getradacctionid(),
            'acctterminatecause' => $radacct->getradacctionid(),
            'servicetype' => $radacct->getradacctionid(),
            'frameprotocol' => $radacct->getradacctionid(),
            'frameipaddress' => $radacct->getradacctionid(),
            'nasportid' => $radacct->getradacctionid(),
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
