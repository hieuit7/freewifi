<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dashboard\Model\Table;

/**
 * Description of RadCheckTable
 *
 * @author hieu
 */
use Zend\Db\TableGateway\TableGateway;
use Dashboard\Model\Entity\RadCheck;

class RadCheckTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getChecks($name, $options = array()) {
        $wheres = array();
        $wheres[] = 'username = ' . $name;
        if (count($options) > 0):
            foreach ($options as $key => $value):
                $wheres[] = $key . ' = ' . $value;
            endforeach;
        endif;

        $resultSet = $this->tableGateway>select($wheres);
        $results = array();
        while (($row = $resultSet->current()) !== null):
            $results[] = $row;
            $resultSet->next();
        endwhile;
        return $results;
    }
    public function getCheck($id) {
        $id = (string)$id;
        $resultSet = $this->tableGateway->select(array('id'=> $id));
        $row = $resultSet->current();
        
        if(!$row):
            throw new Exception('Can\'t find check with id = '.$id);
        endif;
        return $id;        
    }
    public function save(RadCheck $radcheck) {
        
        $data = array(
            'username' => $radcheck->getUsername(),
            'attribute' => $radcheck->getAttribute(),
            'op' => $radcheck->getOp(),
            'value' => $radcheck->getValue()
        );
        $id = (string) $radcheck->getId();
        if ($id == ''):
            $this->tableGateway->insert($data);
        else:
            if($this->getCheck($id)):
                $this->tableGateway->update($data, array('id' => $id));
            endif;
        endif;
    }

}
