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
                        'controller' => 'Universe\Controller\Universe',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(__DIR__ . '/../view'),
    ),
);