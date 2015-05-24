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
use Zend\ServiceManager\ServiceManager;


class PackageCategoryForms extends Form {
    
    protected $sm;
    
    


    //put your code here
    public function __construct($name = null, $options = array(), ServiceManager $sm) {
        $this->sm = $sm;
        parent::__construct('categoryforms', $options);

        $forms = array();
        $this->setAttribute('action', '/modules/addcategory');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'name' => 'name',
            'type' => 'text',
            'options' => array(
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'MUDOLE_NAME_TITLE',
                'required' =>true
            )
        ));
        
        $Appmodules  = $this->sm->get('Dashboard\Model\AppModuleTable');
        $modules = $Appmodules->fetchAll();
        $values = array();
        $values[] = 'FORM_SELECT_MODULE';
        foreach ($modules as $module):
            if($module->getStatus()):
                $values[$module->getId()] = $module->getName();
            endif;
        endforeach;
        
        $this->add(array(
            'type' => 'select',
            'name' => 'value',
            'options' => array(
                'value_options' => $values,
                'required'=> true,
            ),
            'attribute' => array(
                'class' => 'form-control',
            )
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
