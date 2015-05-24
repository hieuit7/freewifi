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

namespace Modules\Forms;

use Zend\Form\Form;

class ModulesForms extends Form {

    //put your code here
    public function __construct($name = null, $options = array()) {
        parent::__construct('modulesforms', $options);

        
        $this->setAttribute('action', '/modules/add');

        $this->add(array(
            'name' => 'name',
            'type' => 'text',
            'options' => array(
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'MUDOLE_NAME_TITLE'
            )
        ));
        $this->add(array(
            'name' => 'attribute',
            'type' => 'text',
            'options' => array(
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'MODULE_ATRRIBUTE'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'status',
            'options' => array(
                'value_options' => array(
                    '1' => 'MODULE_STATUS_ON',
                    '0' => 'MODULE_STATUS_OFF',
                ),
            ),
        ));
        $form = $this->add(array(
            'name' => 'description',
            'type' => 'textarea',
            'options' => array(
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'MODULE_DESCRIPTION_TITLE'
            )
        ));
        
    }

}
