<?php
return array(
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
                        '__NAMESPACE__' => 'Universe\Controller',
                        'controller' => 'Universe',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(__DIR__ . '/../view'),
    ),
);