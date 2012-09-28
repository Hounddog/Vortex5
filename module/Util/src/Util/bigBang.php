<?php
/**
 * This is the almighty file, I promess!
 * @package Util
 * @author pemanteau
 **/
namespace Util;

use Universe\Entity\Universe;
use Universe\Entity\Sector;
use Universe\Entity\Parsec;
use Universe\Entity\Artefact;

/**
 * This class is used to create universe, how godly is that huh? ;)
 */
class BigBang
{

    public function createUniverse(
        $width = 800,
        $height = 800,
        $nbSectors = 5,
        $nbParsecs = 5,
        $nbArtefacts = 4
    )
    {
        if (empty($width)) {
            $width = 800;
        }
        if (empty($height)) {
            $height = 800;
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

        $SectorWidth = $width / $nbSectors;
        $ParsecWidth = $SectorWidth / $nbParsecs;
        $ArtefactWidth = $ParsecWidth / $nbArtefacts;

        $universe = new Universe();
        $universe->setWidth();
        for ($i = 0; $i < $nbSectors; $i++) {
            $sector = new Sector();
            $sector->setWidth($SectorWidth);
            for ($j = 0; $j < $nbParsecs; $j++) {
                $parsec = new Parsec();
                $parsec->setWidth($ParsecWidth);
                for ($k = 0; $k < $nbArtefacts; $k++) {
                    $artefact = new Artefact();
                    $artefact->setWidth($ParsecWidth);
                    $parsec->addArtefact($artefact);
                }
                $sector->addParsec($parsec);
            }
            $universe->addSector($sector);
        }


    }

}