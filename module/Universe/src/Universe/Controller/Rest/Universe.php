<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Universe\Controller\Rest;

use Zend\View\Model\ViewModel;
use ZfcCrudJsonRest\Controller\RestfulController;

class Universe extends RestfulController
{

    public function getList()
    {
        $this->createUniverse();
    }

    public function indexAction()
    {
        $universe = $this->createUniverse();
        $this->getMapper()->create($universe);
    }

    /**
     * @param int $size
     * @param int $nbSectors will be sqrd
     * @param int $nbParsecs will be sqrd
     * @param int $nbArtefacts will be sqrd
     */
    public function createUniverse(
        $size = 800,
        $nbSectors = 5,
        $nbParsecs = 5,
        $nbArtefacts = 4
    )
    {
        if (empty($size)) {
            $size = 800;
        }
        if (empty($nbSectors)) {
            $nbSectors = 5;
        }
        if (empty($nbParsecs)) {
            $nbParsecs = 5;
        }
        if (empty($nbArtefacts)) {
            $nbArtefacts = 5;
        }

        $SectorSize = $size / $nbSectors;
        $ParsecSize = $SectorSize / $nbParsecs;
        $ArtefactSize = $ParsecSize / $nbArtefacts;

        $sectorsTotal = $nbSectors * $nbSectors;
        $parsecsTotal = $nbParsecs * $nbParsecs;
        $artefactsTotal = $nbArtefacts * $nbArtefacts;

        $universe = new \Universe\Entity\Universe();
        $universe->setSize($size);
        $universe->setSubSpacesPerRow($nbSectors);

        $classNames = array('bg0', 'bg1', 'bg2', 'bg3', 'bg4');

        // 80% of void
        // 10% white
        // 5 % yellow
        // 3 % red
        // 2 % blue

        for ($i = 0; $i < $sectorsTotal; $i++) {
            $sector = new \Universe\Entity\Sector();
            $sector->setSize($SectorSize);
            $sector->setSubSpacesPerRow($nbParsecs);

            for ($j = 0; $j < $parsecsTotal; $j++) {
                $parsec = new \Universe\Entity\Parsec();
                $parsec->setSize($ParsecSize);
                $parsec->setSubSpacesPerRow($nbArtefacts);

                for ($k = 0; $k < $artefactsTotal; $k++) {
                    $artefact = new \Universe\Entity\Artefact();
                    $artefact->setSize($ArtefactSize);
                    $rand = rand(0, 100) + 1;
                    switch (true) {
                        case ($rand <= 94) :
                            $index = 0;
                            break;
                        case ($rand <= 96) :
                            $index = 1;
                            break;
                        case ($rand <= 98) :
                            $index = 2;
                            break;
                        case ($rand <= 99) :
                            $index = 3;
                            break;
                        case ($rand <= 100) :
                            $index = 4;
                            break;
                    }
                    $artefact->setCssClass($classNames[$index]);
                    $parsec->addSubSpace($artefact);
                }
                $sector->addSubSpace($parsec);
            }
            $universe->addSubSpace($sector);
        }

        return $universe;
        /*
         return '<div class="map">' . $this->displayUniverse($universe) .
        '</div>' . $this->displayMenu();
        */
    }
}