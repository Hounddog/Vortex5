<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Universe;

use Kernel\Module\AbstractModule;
use Zend\ModuleManager\Feature;
use Zend\Loader;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;


class Module extends AbstractModule
{
    public function getDir()
    {
        return __DIR__;
    }

    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'universe_mapper' => function($sm) {
                    $mapper = $sm->get('crud_db_mapper');
                    $mapper->setEntityClassName('Universe\Entity\Universe');
                    return $mapper;
                },
                'rest_crud_universe_service' => function($sm) {
                    return new \ZfcCrudRest\Service\Restful(
                        $sm->get('universe_mapper')
                    );
                },
            ),
        );
    }

    public function getControllerConfig()
    {
        return array (
            'factories' => array(
                'Universe\Controller\Index' => function($sm) {
                    $controller = new Controller\Index(
                        $sm->getServiceLocator()->get('universe_mapper'),
                        $sm->getServiceLocator()->get('rest_crud_universe_service')
                    );
                    return $controller;
                },
                'Universe\Controller\Universe' => function($sm) {
                    $controller = new Controller\Universe(
                        $sm->getServiceLocator()->get('universe_mapper'),
                        $sm->getServiceLocator()->get('rest_crud_universe_service')
                    );
                    return $controller;
                },
                'Universe\Controller\Sector' => function($sm) {
                    $controller = new Controller\Sector(
                        $sm->getServiceLocator()->get('universe_mapper'),
                        $sm->getServiceLocator()->get('rest_crud_universe_service')
                    );
                    return $controller;
                },
                'Universe\Controller\Parsec' => function($sm) {
                    $controller = new Controller\Index(
                        $sm->getServiceLocator()->get('universe_mapper'),
                        $sm->getServiceLocator()->get('rest_crud_universe_service')
                    );
                    return $controller;
                },
                'Universe\Controller\Artefact' => function($sm) {
                    $controller = new Controller\Index(
                        $sm->getServiceLocator()->get('universe_mapper'),
                        $sm->getServiceLocator()->get('rest_crud_universe_service')
                    );
                    return $controller;
                },
            ),
        );
    }
}