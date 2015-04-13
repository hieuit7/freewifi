<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author hieu
 */

namespace Register\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Users implements InputFilterAwareInterface {

    public $id;
    public $username;
    public $fullname;
    public $password;
    public $email;
    public $phone;
    public $created;
    public $created_by;
    public $building;
    public $room;
    public $activate;
    protected $inputFiler;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->fullname = (isset($data['fullname'])) ? $data['fullname'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->phone = (isset($data['phone'])) ? $data['phone'] : null;
        $this->created = (isset($data['created'])) ? $data['created'] : null;
        $this->created_by = (isset($data['created_by'])) ? $data['created_by'] : null;
        $this->building = (isset($data['building'])) ? $data['building'] : null;
        $this->room = (isset($data['room'])) ? $data['room'] : null;
        $this->active = (isset($data['active'])) ? $data['active'] : null;
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
                 'name'     => 'password',
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
            
            //filter fullname
            $inputFilter->add(array(
                 'name'     => 'fullname',
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
                 'name'     => 'email',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'min'      => 4,
                             'max'      => 100,
                         ),
                     ),
                     array(
                         'name' => 'not_empty',
                     )
                 ),
             ));
            $this->inputFiler = $inputFilter;
        endif;
        return $this->inputFiler;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        $this->inputFiler = $inputFilter;
    }

}
