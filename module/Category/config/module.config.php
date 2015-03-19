<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Category\Controller\Index' => 'Category\Controller\IndexController',
             'Category\Controller\Category' => 'Category\Controller\CategoryController',
         ),
     ),
    
     'router' => array(
         'routes' => array(
            'home' => array(
                 'type'    => 'Zend\Mvc\Router\Http\Literal',
                 'options' => array(
                     'route'    => '/',
                     'defaults' => array(
                         'controller' => 'Category\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'category_home' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/category/[:categoryid]',
                     'defaults' => array(
                         'controller' => 'Category\Controller\Category',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'category_manage' => array(
                 'type'    => 'Zend\Mvc\Router\Http\Literal',
                 'options' => array(
                     'route'    => '/category/manage',
                     'defaults' => array(
                         'controller' => 'Category\Controller\Category',
                         'action'     => 'manage',
                     ),
                 ),
             ),
             'category_add' => array(
                 'type'    => 'Zend\Mvc\Router\Http\Literal',
                 'options' => array(
                     'route'    => '/category/add',
                     'defaults' => array(
                         'controller' => 'Category\Controller\Category',
                         'action'     => 'add',
                     ),
                 ),
             ),
             'category_edit' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/category/edit/[:categoryid]',
                        'constraints'=>array(
                        'id'=>'[0-9]+'
                        ),
                     'defaults' => array(
                         'controller' => 'Category\Controller\Category',
                         'action'     => 'edit',
                     ),
                 ),
             ),
             'category_delete' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/category/delete/[:categoryid]',
                        'constraints'=>array(
                        'id'=>'[0-9]+'
                        ),
                     'defaults' => array(
                         'controller' => 'Category\Controller\Category',
                         'action'     => 'delete',
                     ),
                 ),
             ),
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'category' => __DIR__ . '/../view',
         ),
     ),
 );