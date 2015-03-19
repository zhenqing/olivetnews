<?php
namespace Category\Form;

use Zend\Form\Form;
use \Zend\Form\Element;

class AlbumSearchForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('post');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('method', 'post');


	
        $keyword = new Element\Text('keyword');
        $keyword->setAttribute('class', 'required')
                ->setAttribute('placeholder', 'keyword');
        

        // $title = new Element\Text('title');
        // $title->->setAttribute('class', 'required')
        //         ->setAttribute('placeholder', 'Title');
        



        $submit = new Element\Submit('submit');
        $submit->setValue('Search')
                ->setAttribute('class', 'btn btn-primary');


        $this->add($keyword);
	   //$this->add($title);
	
        $this->add($submit);

    }
}


    