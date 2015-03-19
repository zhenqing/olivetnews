<?php
 namespace Admin\Form;

 use Zend\Form\Form;

 class AdminForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('blog');

        
         
         $this->add(array(
             'name' => 'content',
             'type' => 'Text',
             'options' => array(
                 'label' => 'content',
             ),
         ));
        $this->add(array(
             'name' => 'password',
             'type' => 'Text',
             'options' => array(
                 'label' => 'content',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Add',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }