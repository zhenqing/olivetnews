<?php
namespace Category;
 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
 use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Category\Model\Category;
use Category\Model\CategoryTable;
use Category\Model\Post;
use Category\Model\PostTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

     public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Category\Model\CategoryTable' =>  function($sm) {
                     $tableGateway = $sm->get('CategoryTableGateway');
                     $table = new CategoryTable($tableGateway);
                     return $table;
                 },
                 'Category\Model\Category' =>  function($sm) {
                     $table = new Category();
                     return $table;
                 },
                 'CategoryTableFactory'=>'Category\Model\CategoryTableFactory',
                 'CategoryTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Category());
                     return new TableGateway('categories', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Category\Model\PostTable' =>  function($sm) {
                     $tableGateway = $sm->get('PostTableGateway');
                     $table = new PostTable($tableGateway);
                     return $table;
                 },
                 'PostTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $categoryService = $sm->get('Category\Model\CategoryTable');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Post($categoryService));
                     return new TableGateway('posts', $dbAdapter, null, $resultSetPrototype);
                 }
             ),
         );
     }
}
