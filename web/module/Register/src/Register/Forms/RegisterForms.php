<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisterForms
 *
 * @author hieu
 */

namespace Register\Forms;

use Zend\Form\Form;

class RegisterForms extends Form {

    //put your code here

    public function __construct($name = null) {
        parent::__construct('registerform');
        $forms = array();

        //username;
        $this->add(array(
            'name' => 'username',
            'type' => 'text',
            'options' => array(
                'label' => 'USERNAME',
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        //fullname 
        $this->add(array(
            'name' => 'fullname',
            'type' => 'text',
            'options' => array(
                'label' => 'FULLNAME'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        //password
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'options' => array(
                'label' => 'PASSWORD'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        //retype
        $this->add(array(
            'name' => 'retype',
            'type' => 'password',
            'options' => array(
                'label' => 'REPASSWORD'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        //email
        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'EMAIL'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        //building
        $this->add(array(
            'name' => 'building',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'SELECTBUILDING',
                'empty_options' => 'SELECTEMPTY',
                'value_options' => array(
                    '1' => 'IT Building',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        //room
        $this->add(array(
            'name' => 'room',
            'type' => 'text',
            'options' => array(
                'label' => 'ROOM'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        //fone
        $this->add(array(
            'type' => 'text',
            'name' => 'phone',
            'options' => array(
                'label' => 'PHONENUMBER'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        //capcha
//        $this->add(array(
//            'type' => 'Zend\Form\Element\Captcha',
//            'name' => 'captcha',
//            'options' => array(
//                'label' => 'Please verify you are human',
//                'captcha' => new \Zend\Captcha\Dumb()
//            )
//        ));
        //submit
        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
        ));
    }

}
