<?php
namespace Category\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
 
class PostForm extends Form 
//implements InputFilterProviderInterface
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('blog');
        //CSRF protection
        $this->add(array(
             'type' => 'Zend\Form\Element\Csrf',
             'name' => 'csrf',
             'options' => array(
                     'csrf_options' => array(
                          'timeout' => 600
                     )
             )
        ));
        
        //id field
        $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
        ));
        
        $this->add(array(
             'name' => 'title',
             'type' => 'Text',
             'attributes'=>array(
                'placeholder'=>'Category',
                'class'=>'form-control', 
             ),
             'options' => array(
                 'label' => 'Title',
            ),
        ));
        
        $this->add(array(
             'name' => 'content',
             'type' => 'Textarea',
             'attributes'=>array(
                'class'=>'form-control', 
             ),
             'options' => array(
                 'label' => 'Content',
            ),
        ));
        $this->add(array(
             'name' => 'author',
             'type' => 'Text',
             'attributes'=>array(
                'class'=>'form-control', 
             ),
             'options' => array(
                 'label' => 'Author',
            ),
        ));
        $this->add(array(
             'name' => 'imgurl',
             'type' => 'File',
             'attributes'=>array(
                'placeholder'=>'',
                'class'=>'form-control'
             ),
             'options' => array(
                 'label' => 'Image',
            ),
        ));
        
        $this->add(array(
             'name' => 'category_name',
             'type' => 'Text',
             'attributes'=>array(
                'class'=>'form-control', 
             ),
             'options' => array(
                 'label' => 'Category',
            ),
        ));
        $this->add(array(
             'name' => 'status',
             'type' => 'Text',
             'attributes'=>array(
                'class'=>'form-control', 
             ),
             'options' => array(
                 'label' => 'Status',
            ),
        ));
        $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Submit',
                 'id' => 'submitbutton',
            ),
        ));
    }
      public function addElements()
    {
        // File Input
        $file = new Element\File('image-file');
        $file->setLabel('Avatar Image Upload')
             ->setAttribute('id', 'image-file');
        $this->add($file);
    }

     // public function getInputFilterSpecification()
     // {
     //     return array(
         
     //        'id' => array(
                
     //             'required' => false,
     //             'filters'  => array(
     //                 array('name' => 'Int'),
     //             ),
     //         ),
     //        'author'=>array(
     //             'required' => true,
     //             'filters'  => array(
     //                 array('name' => 'StripTags'),
     //                 array('name' => 'StringTrim'),
     //             ),
     //             'validators' => array(
     //                 array(
     //                     'name'    => 'StringLength',
     //                     'options' => array(
     //                         'encoding' => 'UTF-8',
     //                         'min'      => 1,
     //                         'max'      => 100,
     //                     ),
     //                 ),
     //             ),
     //         ),
     //         'title'=>array(
                 
     //             'required' => true,
     //             'filters'  => array(
     //                 array('name' => 'StripTags'),
     //                 array('name' => 'StringTrim'),
     //             ),
     //             'validators' => array(
     //                 array(
     //                     'name'    => 'StringLength',
     //                     'options' => array(
     //                         'encoding' => 'UTF-8',
     //                         'min'      => 1,
     //                         'max'      => 100,
     //                     ),
     //                 ),
     //             ),
     //         ),
             
     //         'content'=>array(
     //             'required' => true,
     //             'filters'  => array(
     //                 array('name' => 'StripTags'),
     //                 array('name' => 'StringTrim'),
     //             )
     //         )
     //     );
          
     // }
}