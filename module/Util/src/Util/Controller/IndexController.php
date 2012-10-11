<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Util\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Util\Universe\BigBang;

class IndexController extends AbstractActionController
{
    private $service;
    private $mapper;

    public function __construct($mapper, $service)
    {
        $this->mapper = $mapper;
        $this->service = $service;
    }

    public function indexAction()
    {
        $bigBang = new BigBang();
        $universe = $bigBang->createUniverse();
        $this->mapper->insert($universe);
//        $this->getServiceUniverse()->save($bigBang->getUniverse());
        return array('table' => 'done!');
    }
}
