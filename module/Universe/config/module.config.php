<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'rest_crud_universe_mapper' => function($sm) {
                return new RestCrudDoctrineModule\Mapper\BaseMapper(
                    $sm->get('doctrine.entitymanager.orm_default'),
                    'Universe\Entity\Universe'
                );
            },
            'rest_crud_universe_service' => function($sm) {
                return new RestCrudDoctrineModule\Service\BaseRestService(
                    $sm->get('rest_crud_universe_mapper')
                );
            },
        ),
    ),
/*
    http://vortex5/universe/sector/4
    accept-content "application/json" => rest

    http://vortex5/universe/sector/4
    accept-content "text/html" => html
*/
    'router' => array(
        'routes' => array(
            'universe' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/universe',
                    'defaults' => array(
                        'controller' => 'Universe\Controller\Index',
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
            'Universe\Controller\Index' => function($sm) {
                $accept = $sm->getServiceLocator()
                    ->get('application')
                    ->getRequest()
                    ->getHeader('accept');
                ;
                switch (true) {
                    case (false !== $accept->match('text/html')):
                        break;
                    case (false !== $accept->match('application/json')):
                        break;
                }

                $controller = new Universe\Controller\Index(
                    $sm->getServiceLocator()->get('rest_crud_universe_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_universe_service')
                );
                return $controller;
            },
            'Universe\Controller\Universe' => function($sm) {
                $accept = $sm->getServiceLocator()
                    ->get('application')
                    ->getRequest()
                    ->getHeader('accept');
                ;
                switch (true) {
                    case (false !== $accept->match('text/html')):
                        $ctrlr = 'Universe\Controller\Universe';
                        break;
                    case (false !== $accept->match('application/json')):
                        $ctrlr = 'Universe\Controller\Rest\Universe';
                        break;
                }
                $controller = new $ctrlr(
                    $sm->getServiceLocator()->get('rest_crud_universe_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_universe_service')
                );
                return $controller;
            },
            'Universe\Controller\Sector' => function($sm) {
                $controller = new Universe\Controller\Index(
                    $sm->getServiceLocator()->get('rest_crud_universe_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_universe_service')
                );
                return $controller;
            },
            'Universe\Controller\Parsec' => function($sm) {
                $controller = new Universe\Controller\Index(
                    $sm->getServiceLocator()->get('rest_crud_universe_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_universe_service')
                );
                return $controller;
            },
            'Universe\Controller\Artefact' => function($sm) {
                $controller = new Universe\Controller\Index(
                    $sm->getServiceLocator()->get('rest_crud_universe_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_universe_service')
                );
                return $controller;
            },
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(__DIR__ . '/../view'),
    ),
);