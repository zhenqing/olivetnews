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

    	$postService = $this->getServiceLocator()->get("Category\Model\CategoryTable");
		  $posts = $postService->getCategorysByCategoryId($cat_id);
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
    
    if($this->getRequest()->isCategory()){
      $this->_initCategory();
      $this->saveCategoryFromCategory($form);
    }
    
    return array('form' => $form);
    }
    /**
   * 
   * Save the category after user submission
   */
  protected function saveCategoryFromCategory($form){
    $data = $this->getRequest()->getCategory();
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

     public function editAction()
  {
     $id = (int) $this->params()->fromRoute('categoryid', 0);
         if (!$id) {
             return $this->redirect()->toRoute('category', array(
                 'action' => 'add'
             ));
         }
         $categoryTable = $this->getServiceLocator()->get("Category\Model\CategoryTable");
          
         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
           $category = $categoryTable->getById($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('category', array(
                 'action' => 'index'
             ));
         }

         $form  = new CategoryForm();
         $form->bind($category);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($category->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $categoryTable->saveCategory($category);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('category');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
  }
  public function deleteAction(){
    $this->_initCategory();
    $categoryTable = $this->getServiceLocator()->get("Blog\Model\BlogTable");
    $categoryTable->deleteBlog($this->category);
    $this->redirect()->toRoute('category_home');
  }
  public function viewAction()
  {
    try{
      $this->_initCategory(); 
      if (! is_int($this->category->getId()) ){
        throw new \Exception("No category found");
      }
        
      return array(
            'category'=>$this->category
      );
    }catch (\Exception $e){
      //todo: add error handling functions.
    }
  }
}
