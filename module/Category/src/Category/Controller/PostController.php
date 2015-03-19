<?php


namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Category\Form\PostForm;
use Category\Model\Post;
class PostController extends AbstractActionController
{
  protected $post;
    function _initPost($id=null){
    if($id == null){
      $id = $this->params()->fromRoute('id',0);
    }
    if ($id < 1) {
      $this->post = new Post();
    } else {
      $postTable = $this->getServiceLocator()->get("Category\Model\PostTable");
      $post = $postTable->getById($id);
      $this->post = $post;
    }
  }
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
    public function addAction(){
      $form = new PostForm();
    
    if($this->getRequest()->isPost()){
      $this->_initPost();
      $this->savePostFromCategory($form);
    }
    
    return array('form' => $form);
    }
    /**
   * 
   * Save the category after user submission
   */
  protected function savePostFromCategory($form){
    $data = $this->getRequest()->getPost();
      //@todo: validate the data
    $form->setData($data);
        if ($form->isValid()) {
      
      $this->post->exchangeArray($form->getData());
      $postTable = $this->getServiceLocator()->get("Category\Model\PostTable");
      $this->post = $postTable->savePost($this->post);
        
      if($id = $this->post->getId()){
        $this->redirect()->toRoute('home');
      }
        }else{
          
        }
  }
   
   
}
