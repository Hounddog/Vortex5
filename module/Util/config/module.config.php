<?php
return array(
    'router' => array(
        'routes' => array(
            'util' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/util',
                    'defaults' => array(
                        'controller' => 'Util\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Util\Controller\Index' => 'Util\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(__DIR__ . '/../view'),
    ),

);