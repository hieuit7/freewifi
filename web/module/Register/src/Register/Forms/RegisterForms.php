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
            
            'attributes' => array(
                'class' => 'form-control',
            ),
            'label' => 'USERNAME',
        ));
        
        //fullname 
        $this->add(array(
            'name' => 'fullname',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control'
            ),
            'label' => 'USERNAME',
        ));
        //password
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        //retype
        $this->add(array(
            'name' => 'retype',
            'type' => 'password',
            'attributes' => array(
                'class' => 'form-control'
            ),
            'label' => 'USERNAME',
        ));
        //email
        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array(
                'class' => 'form-control'
            ),
            'label' => 'USERNAME',
        ));
        //building
        $this->add(array(
            'name' => 'building',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'empty_options' => 'SELECTEMPTY',
                'value_options' => array(
                    '1' => 'IT Building',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),'label' => 'USERNAME',
        ));
        //room
        $this->add(array(
            'name' => 'room',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control'
            ),'label' => 'USERNAME',
        ));
        //fone
        $this->add(array(
            'type' => 'text',
            'name' => 'phone',
            'attributes' => array(
                'class' => 'form-control'
            ),
            'label' => 'USERNAME',
        ));
        //capcha
        $this->add(array(
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => array(
                'label' => 'Please verify you are human',
                'captcha' => new \Zend\Captcha\Dumb()
            ),
            'label' => 'USERNAME',
        ));
        //submit
        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
        ));
    }

}
