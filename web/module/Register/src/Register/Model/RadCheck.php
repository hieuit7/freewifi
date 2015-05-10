<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Register\Model;

/**
 * Description of RadCheck
 *
 * @author hieu
 */
class RadCheck {
    protected $id;
    protected $username;
    protected $attribute;
    protected $op;
    protected $value;
    
    public function exchangeArray($data) {
        $this->id = (isset($data['id']))?$data['id']:null;
        $this->username = (isset($data['username']))?$data['username']:null;
        $this->attribute = (isset($data['attribute']))?$data['attribute']:null;
        $this->op = (isset($data['op']))?$data['op']:null;
        $this->value = (isset($data['value']))?$data['value']:null;        
    }
    
    public function setId($Id) {
        $this->id = $id;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function setAttribute($attribute) {
        $this->attribute = $attribute;
    }
    public function setOp($op) {
        $this->op = $op;
    }
    public function setValue($value) {
        $this->value = $value;
    }
    public function getId() {
        return $this->id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getAttribute() {
        return $this->attribute;
    }
    public function getOp() {
        return $this->op;
    }
    public function getValue() {
        return $this->value;
    }
    public function getInputFilter() {
        if (!$this->inputFiler):
            $inputFilter = new InputFilter();
            //filter for username
            $inputFilter->add(array(
                'name' => 'username',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            //password
            
            $inputFilter->add(array(
                 'name'     => 'op',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
            $inputFilter->add(array(
                 'name'     => 'value',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
            $this->inputFiler = $inputFilter;
        endif;
        return $this->inputFiler;
    }
}
