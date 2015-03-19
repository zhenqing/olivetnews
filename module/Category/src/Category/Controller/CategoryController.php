<?php


namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoryController extends AbstractActionController
{
    public function indexAction()
    {
    	$cat_id=$this->params()->fromRoute('categoryid');
    	$categoryService = $this->getServiceLocator()->get("Category\Model\CategoryTable");
        $categories = $categoryService->fetchAll();
        $categories->buffer();

    	$postService = $this->getServiceLocator()->get("Category\Model\PostTable");
		$posts = $postService->getPostsByCategoryId($cat_id);
		return array('categories'=>$categories,'cat_id'=>$cat_id,'posts'=>$posts);
    }
   public function manageAction()
    {
    	
    	$categoryService = $this->getServiceLocator()->get("Category\Model\CategoryTable");
          var_dump(get_class($categoryService));
          $categories = $categoryService->fetchAll();
          $categories->buffer();
          return array('categories'=>$categories);
    }
}
