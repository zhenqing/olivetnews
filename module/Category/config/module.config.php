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
                 'type'    => 'Zend\Mvc\Router\Http\Literal',
                 'options' => array(
                     'route'    => '/category',
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
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'category' => __DIR__ . '/../view',
         ),
     ),
 );