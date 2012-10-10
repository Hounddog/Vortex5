<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'rest_crud_universe_mapper' => function($sm) {
                return new Mapper\BaseMapper(
                    $sm->get('doctrine.entitymanager.orm_default'),
                    'Universe\Entity\Universe'
                );
            },
            'rest_crud_universe_service' => function($sm) {
                return new Service\BaseRestService(
                    $sm->get('rest_crud_universe_mapper')
                );
            },
        ),
    ),
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