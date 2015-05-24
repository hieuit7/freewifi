<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Forms;

/**
 * Description of ProductFroms
 *
 * @author hieu
 */
use Zend\Form\Form;
use Zend\ServiceManager\ServiceManager;
class ProductFroms extends Form{
    protected $sm;
    //put your code here
    public function __construct($name = null, $options = array(),  ServiceManager $sm) {
        $this->sm = $sm;
        parent::__construct($name, $options);
        $this->setAttribute('action', '/modules/addpacket');
        $this->add(array(
            'name' => 'name',
            'type' => 'text',
            'options' => array(
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'PACKET_NAME_TITLE'
            )
        ));
        $ProductCategoryTable = $sm->get('Dashboard\Model\AppProductCategoriesTable');
        $categories = $ProductCategoryTable->fetchAll();
        $values = array();
        $values[] = 'FORM_SELECT_CATEGORY';
        foreach ($categories as $category):
            $values[$category->getId()] = $category->getName();
        endforeach;
        $this->add(array(
            'type' => 'select',
            'name' => 'category',
            'options' => array(
                'value_options' => $values,
                'required'=> true
            ),
            'attributes' => array(
                'class' => 'form-control selectpicker',
            )
        ));
        $this->add(array(
            'name' => 'price',
            'type' => 'text',
            'options' => array(
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'PACKET_PRICE_TITLE'
            )
        ));
        $this->add(array(
            'name' => 'unit',
            'type' => 'text',
            'options' => array(
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'PACKET_UNIT_TITLE'
            )
        ));
        $this->add(array(
            'name' => 'value',
            'type' => 'text',
            'options' => array(
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'PACKET_VALUE_TITLE'
            )
        ));
        $this->add(array(
            'name' => 'description',
            'type' => 'textarea',
            'options' => array(
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'PACKET_DESC_TITLE'
            )
        ));
        
        
    }
    
    
    
}
