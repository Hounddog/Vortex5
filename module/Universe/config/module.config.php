<?php
return array(
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
/*
    http://vortex5.local/universe/sector/4
    accept-content "application/json" => rest

    http://vortex5/universe/sector/4
    accept-content "text/html" => html
*/
    'router' => array(
        'routes' => array(
            'universe' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/universe',
                    'defaults' => array(
                        'controller' => 'Universe\Controller\Universe',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'controller_universe' => function($sm) {
                return new Universe\Controller\Universe(
                    $sm->getServiceLocator()->get('universe_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_universe_service')
                );
            },
            'controller_universe_rest' => function($sm) {
                return new Universe\Controller\Rest\Universe(
                    $sm->getServiceLocator()->get('universe_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_universe_service')
                );
            },
            'Universe\Controller\Index' => function($sm) {
                $controller = new Universe\Controller\Index(
                    $sm->getServiceLocator()->get('universe_mapper'),
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
                        $controller =  $sm->get('controller_universe');
                        break;
                    case (false !== $accept->match('application/json')):
                        $controller = $sm->get('controller_universe_rest');
                        break;
                }
                return $controller;
            },
            'Universe\Controller\Sector' => function($sm) {
                $controller = new Universe\Controller\Index(
                    $sm->getServiceLocator()->get('universe_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_universe_service')
                );
                return $controller;
            },
            'Universe\Controller\Parsec' => function($sm) {
                $controller = new Universe\Controller\Index(
                    $sm->getServiceLocator()->get('universe_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_universe_service')
                );
                return $controller;
            },
            'Universe\Controller\Artefact' => function($sm) {
                $controller = new Universe\Controller\Index(
                    $sm->getServiceLocator()->get('universe_mapper'),
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