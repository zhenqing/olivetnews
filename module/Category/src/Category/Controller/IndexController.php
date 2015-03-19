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
		$paginator = $postService->fetchAll(true);
		$paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
		$paginator->setItemCountPerPage(2);
		return array('categories'=>$categories,'paginator'=>$paginator);
    }
   
}
