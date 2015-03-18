<?php


namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$categoryService = $this->getServiceLocator()->get("Category\Model\CategoryTable");
        $categories = $categoryService->fetchAll();
        $categories->buffer();

    	$postService = $this->getServiceLocator()->get("Category\Model\PostTable");
		$posts = $postService->fetchAll();
		return array('categories'=>$categories,'posts'=>$posts);
    }
   
}
