<?php


namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	
    	$postService = $this->getServiceLocator()->get("Category\Model\PostTable");
		
		$posts = $postService->fetchAll();
		
		return array('posts'=>$posts);
    }
   
}
