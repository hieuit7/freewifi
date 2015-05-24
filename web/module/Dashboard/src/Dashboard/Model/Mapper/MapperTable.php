<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mapper
 *
 * @author hieu
 */

namespace Dashboard\Model\Mapper;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class MapperTable extends AbstractTableGateway{

    protected $tableGateway;
    
    protected $_key;
    
    public function __construct(\Zend\Db\TableGateway\TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
        $this->table = $this->tableGateway->getTable();
        $this->adapter = $this->tableGateway->getAdapter();
    }

    public function customGetData($page = 1, $limit = 10, $wheres = array(), $orders = array(), $joins = array(), &$paging) {
        $selector = new Select();
        $selector->from(array(
            'a' => $this->tableGateway->getTable()
        ));
        if (is_array($wheres)):
            $selector->where($wheres);
        endif;
        if (is_array($orders)):
            $selector->order($orders);
        endif;
        if (is_array($joins)):
            foreach ($joins as $join) {
                $selector->join(array($join['alias'] => $join['table']), $join['on'], $join['columns'], $join['type']);
            }
        endif;

        if ($page):
            $selector->offset(($page - 1) * $limit);
        endif;
        if ($limit):
            $selector->limit($limit);
        endif;
        
        $selector->group($this->tableGateway->getResultSetPrototype()->getArrayObjectPrototype()->getKey());
        $resulSetPrototype = $this->tableGateway->getResultSetPrototype();

        $PaginatorAdapter = new DbSelect($selector, $this->tableGateway->getAdapter());
        $paging = new Paginator($PaginatorAdapter);
        
        //$resultSet = $this->tableGateway->selectWith($selector);
        $resultSet = $this->selectWith($selector);
        
        $result = array();
        while ($row = $resultSet->current()):
            $result[] = $row->exchangeArray($row);
            $resultSet->next();
        endwhile;
        return $result;
    }

}
