<?php
/**
 * This is the almighty file, I promess!
 * @package Util
 * @author pemanteau
 **/
namespace Util\Universe;

use Universe\Interfaces\HasSubSpaces;
use Universe\Interfaces\IsSubSpaces;
use Universe\Interfaces\DarkMatter;
use Universe\Entity\Universe;
use Universe\Entity\Sector;
use Universe\Entity\Parsec;
use Universe\Entity\Artefact;

/**
 * This class is used to create universe, how godly is that huh? ;)
 */
class BigBang
{

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

        $universe = new Universe();
        $universe->setSize($size);
        $universe->setSubSpacesPerRow($nbSectors);

        $classNames = array(
            'bg0',
            'bg1',
            'bg2',
            'bg3',
            'bg4'
        );

        // 80% of void
        // 10% white
        // 5 % yellow
        // 3 % red
        // 2 % blue

        for ($i = 0; $i < $sectorsTotal; $i++) {
            $sector = new Sector();
            $sector->setSize($SectorSize);
            $sector->setSubSpacesPerRow($nbParsecs);

            for ($j = 0; $j < $parsecsTotal; $j++) {
                $parsec = new Parsec();
                $parsec->setSize($ParsecSize);
                $parsec->setSubSpacesPerRow($nbArtefacts);

                for ($k = 0; $k < $artefactsTotal; $k++) {
                    $artefact = new Artefact();
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