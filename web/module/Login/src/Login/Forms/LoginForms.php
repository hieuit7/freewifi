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

class LoginForms extends Form{
    //put your code here
    public function __construct($name = null, $options = array()) {
        parent::__construct('loginform', $options);
        
        $forms = array();
        $this->add(array(
            'name' => 'username',
            'type' => 'text',
            'options' => array(
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Username'
            )
        ));
        
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Password'
            )
        ));
        
        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'options' => array(
                
                'label' => 'Login',  
            ),
            
            'attributes' => array(
                'value' =>'Login',
                'class' =>'btn btn-lg btn-success btn-block'
            )
        ));
        
    }
}
