<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Universe\Controller;

use Zend\View\Model\JsonModel;
use ZfcCrudRest\Controller\RestfulController;

class Universe extends RestfulController
{

    /**
     * The Doctrine Mapper
     * @var Mapper\DoctrineDb
     */
    protected $mapper;

    protected $service;

    public function __construct(\ZfcCrud\Mapper\DbMapperInterface $mapper, $service)
    {
        $this->mapper = $mapper;
        $this->service = $service;
    }

    public function getList()
    {
        $universe = $this->mapper->findById(1);

        return array(
            'table' => '<div class="map">' .
            $this->displayUniverse($universe) . '</div>' . $this->displayMenu(),
            'universe' => $universe
        );
    }

    private function displayUniverse(\Universe\Entity\Universe $universe)
    {
        $size = $universe->getSize();
        $output = '<table border="0" cellpadding="0" cellspacing="0" ' .
                        'style="width:' . $size . 'px;' .
                        'height:' . $size . 'px;"><tbody class="' . get_class($universe) .
                        '"><tr>';
        $output .= $this->displayEntity($universe);
        $output .= '</tr></tbody></table>';

        return $output;
    }

    private function displayEntity(\Universe\Interfaces\DarkMatter $entity)
    {
        $str = '';
        $class = $this->getClass($entity);
        if ($entity instanceof \Universe\Interfaces\HasSubSpaces) {
            $size = $entity->getSize();
            $subspaces = $entity->getSubSpaces();
            $nbPerRow = $entity->getSubSpacesPerRow();

            $str .= '<td style="width:' . $size . 'px;height:' .
                            $size . 'px;" class="' . $class . '">';

            $str .= '<!-- start children of ' . get_class($entity) . ' -->';
            $str .= '<table border="0" cellpadding="0" cellspacing="0" cols="' .
                            $nbPerRow . '" style="width:' . $size . 'px;height:' .
                            $size . 'px;"><tbody><tr>';

            $i = 0;
            foreach ($subspaces as $subspace) {
                $str .= $this->displayEntity($subspace);
                $i++;
                if ($i % $nbPerRow == 0) {
                    $str .= '</tr><tr>';
                }
            }
            $str .= '</tbody></tr></table>';
            $str .= '<!-- start children of ' . get_class($entity) . ' -->' .
                            '</td>';
        } else {
            $size = $entity->getSize();
            $str .= '<td class="' . $class . ' ' . $entity->getCssClass() .
            '" style="width:' . $size . 'px;height:' . $size . 'px;"></td>';
        }
        return $str;
    }

    private function getClass(\Universe\Interfaces\DarkMatter $entity)
    {
        $type = get_class($entity);
        $class = 'universe sector parsec artefact';
        switch ($type) {
            case 'Universe\Entity\Universe':
                $class = 'universe';
                break;
            case 'Universe\Entity\Sector':
                $class = 'universe sector';
                break;
            case 'Universe\Entity\Parsec':
                $class = 'universe sector parsec';
                break;
        }
        return $class;
    }

    private function displayMenu()
    {
        $str = '';

        $str .= '<div class="actionMenu"></div>';

        return $str;
    }

    public function create($data)
    {
        $this->createUniverse();
        $universe = $this->getMapper()->create($universe);
        return $this->getMapper()->entityToArray($entity);
    }

    /**
     * @param int $size
     * @param int $nbSectors will be sqrd
     * @param int $nbParsecs will be sqrd
     * @param int $nbArtefacts will be sqrd
     */
    public function createUniverse(
        $size = 800, $nbSectors = 5, $nbParsecs = 5, $nbArtefacts = 4
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
    }


}