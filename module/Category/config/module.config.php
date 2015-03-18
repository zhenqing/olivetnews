<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Category\Controller\Index' => 'Category\Controller\IndexController',
         ),
     ),
      // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'category_home' => array(
                 'type'    => 'Zend\Mvc\Router\Http\Literal',
                 'options' => array(
                     'route'    => '/category',
                     'defaults' => array(
                         'controller' => 'Category\Controller\Index',
                         'action'     => 'index',
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