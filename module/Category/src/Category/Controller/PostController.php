<?php


namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    public function indexAction()
    {
    	
    	$postService = $this->getServiceLocator()->get("Category\Model\PostTable");
		$paginator = $postService->fetchAll(true);
		$paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
		$paginator->setItemCountPerPage(2);
     	
		return array('categories'=>$categories,'paginator'=>$paginator);
    }

    public function viewAction()
    {
        //return new ViewModel();
      $id = $this->params()->fromRoute('id');
      echo $id;
      $postService = $this->getServiceLocator()->get("Category\Model\PostTable");
       $post = $postService->fetchById($id);
       if(count($post)<1){
        throw new Exception("No database in system", 1);
        
       }else{
        return array('post'=>$post->current());
       }
      
    }
   
   
}
