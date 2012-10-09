<?php
return array(
    'modules' => array(
        'AssetManager',
        'Application',
	    'Kernel',
        'ZfcBase',
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        'ZfcAdmin',
        'ZfcUserAdmin',
        'RestCrudDoctrineModule',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
            './module-dev',
        ),
    ),
);
