<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'ZendSkeletonModule\Controller\Skeleton' => 'ZendSkeletonModule\Controller\SkeletonController',
        ),
        'factories' => array(
            'ZendSkeletonModule\Controller\Rest' => function($sm) {
                $controller = new ZendSkeletonModule\Controller\RestController(
                    $sm->getServiceLocator()->get('rest_crud_base_mapper'),
                    $sm->getServiceLocator()->get('rest_crud_base_service')
                );
                return $controller;
            }
        ),
    ),
    'router' => array(
        'routes' => array(
            'testing' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/test', // vortex5.local/test
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'ZendSkeletonModule\Controller',
                        'controller'    => 'Skeleton',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/rest[/:id]',
                            'constraints' => array(
                                'id' => '[a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'ZendSkeletonModule\Controller\Rest',
                                'action' => null
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'ZendSkeletonModule' => __DIR__ . '/../view',
        ),
    ),
);
