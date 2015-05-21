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

namespace Dashboard\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Users implements InputFilterAwareInterface {

    protected $id;
    protected $username;
    protected $fullname;
    protected $password;
    protected $email;
    protected $phone;
    protected $packet;
    protected $created;
    protected $created_by;
    protected $building;
    protected $room;
    protected $activate;
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
        $this->active = (isset($data['active'])) ? $data['active'] : 0;
        $this->packet = (isset($data['packet'])) ? $data['packet'] : null;
    }
    public function setId($id) {
        $this->id = id;
    }
    public function setPacket($packet) {
        $this->packet = $packet;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    public function setCreated($created) {
        $this->created = $created;
    }

    public function setRoom($room) {
        $this->room = $room;
    }
    public function setCreatedBy($createdBy) {

        $this->created_by = $createdBy;
    }
    public function setBuilding($building) {
        $this->building = $building;
    }
    public function setActivate($active) {
        $this->activate = $active;
    }
    public function getId() {
        return $this->id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getFullname() {
        return $this->fullname;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getPacket() {
        return $this->packet;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getCreated() {
        return $this->created;
    }
    public function getPhone() {
        return $this->phone;
    }
    public function getCreatedBy() {
        return $this->created_by;
    }
    public function getBuilding() {
        return $this->building;
    }
    public function getRoom() {
        return $this->room;
    }
    public function getActivate() {
        return $this->activate;
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
