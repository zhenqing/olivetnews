<?php


namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	
    	$categoryService = $this->getServiceLocator()->get("Category\Model\CategoryTable");
          var_dump(get_class($categoryService));
          $categories = $categoryService->fetchAll();
          $categories->buffer();
          return array('categories'=>$categories);
    }
   
}
