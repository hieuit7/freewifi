<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_Login_Form
 *
 * @author hieun_000
 */
namespace Login\Forms;
 
use Zend\Form\Form;
class Form_Login_Form extends Form{
    //put your code here
    public function __construct($name = null, $options = array()) {
        parent::__construct('loginform', $options);
        
        $forms = array();
        $this->add(array(
            'name' => 'username',
            'type' => 'text',
            'options' => array(
                'label' => 'USERNAME'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
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
        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
        ));
        
    }
}
