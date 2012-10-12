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

class Module
    extends AbstractModule implements Feature\BootstrapListenerInterface
{
    public function getDir()
    {
        return __DIR__;
    }

    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    public function getDoctrineConfig()
    {
        return array();
    }


    /**
     * @{inheritdoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        $app = $e->getParam('application');
        $em  = $app->getEventManager();

        $em->attach(
            MvcEvent::EVENT_DISPATCH,
            array($this, 'selectControllerOnRouteAndAcceptContent')
        );
    }

    /**
     * Select the right controller depending on the route and accept-content
     * header value
     * @param  MvcEvent $e
     * @return void
     */
    public function selectControllerOnRouteAndAcceptContent(MvcEvent $e)
    {
        $app    = $e->getParam('application');
        $sm     = $app->getServiceManager();
        $config = $sm->get('config');

        if (false === $config['zfcadmin']['use_admin_layout']) {
            return;
        }

        $match = $e->getRouteMatch();
        if (!$match instanceof RouteMatch
                || 0 !== strpos($match->getMatchedRouteName(), 'zfcadmin')
        ) {
            return;
        }

        $controller = $config['universe']['...'];
        $controller = $e->getTarget();
        $controller->layout($layout);
    }


}