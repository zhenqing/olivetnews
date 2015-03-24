<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Admin\Controller\Index' => 'Admin\Controller\IndexController',
             'Admin\Controller\Success' => 'Admin\Controller\SuccessController',
         ),
     ),
    
     'router' => array(
         'routes' => array(
            'login' => array(
                 'type'    => 'Zend\Mvc\Router\Http\Literal',
                 'options' => array(
                     'route'    => '/admin',
                     'defaults' => array(
                         'controller' => 'Admin\Controller\Index',
                         'action'     => 'login',
                     ),
                 ),
               'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
             ),
            'success' => array(
                 'type'    => 'Zend\Mvc\Router\Http\Literal',
                 'options' => array(
                     'route'    => '/success',
                     'defaults' => array(
                         'controller' => 'Admin\Controller\Success',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'admin' => __DIR__ . '/../view',
         ),
     ),
 );