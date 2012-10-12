<?php
return array(
/*
    'service_manager' => array(
        'factories' => array(
            'universe_mapper' => function($sm) {
                $mapper = $sm->get('crud_db_mapper');
                $mapper->setEntityClassName('Universe\Entity\Universe');
                return $mapper;
            },
            'rest_crud_universe_service' => function($sm) {
                return new ZfcCrudJsonRest\Service\Restful(
                    $sm->get('universe_mapper')
                );
            },
        ),
    ),
*/
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
//            'Util\Controller\Index' => 'Util\Controller\IndexController'
        ),
        'factories' => array(
            'Util\Controller\Index' => function($sm) {
                $controller = new Util\Controller\IndexController(
                    $sm->getServiceLocator()->get('universe_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_universe_service')
                );
                return $controller;
            }
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(__DIR__ . '/../view'),
    ),

);