<?php


namespace Category\Controller;
use Category\Model\Category;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Category\Form\CategoryForm;
class CategoryController extends AbstractActionController
{
  protected $category;
  function _initCategory($id=null){
    if($id == null){
      $id = $this->params()->fromRoute('categoryid',0);
    }
    if ($id < 1) {
      $this->category = new Category();
    } else {
      $categoryTable = $this->getServiceLocator()->get("Category\Model\CategoryTable");
      $category = $categoryTable->getById($id);
      $this->category = $category;
    }
  }
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
    public function addAction(){
      $form = new CategoryForm();
    
    if($this->getRequest()->isPost()){
      $this->_initCategory();
      $this->saveCategoryFromPost($form);
    }
    
    return array('form' => $form);
    }
    /**
   * 
   * Save the category after user submission
   */
  protected function saveCategoryFromPost($form){
    $data = $this->getRequest()->getPost();
      //@todo: validate the data
    $form->setData($data);
        if ($form->isValid()) {
      
      $this->category->exchangeArray($form->getData());
      $categoryTable = $this->getServiceLocator()->get("Category\Model\CategoryTable");
      $this->category = $categoryTable->saveCategory($this->category);
        
      if($id = $this->category->getId()){
        $this->redirect()->toRoute('category_home');
      }
        }else{
          
        }
  }

     public function editAction(){
      return new ViewModel();
      
    }
}
