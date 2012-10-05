<?php
/**
 * This class is an interface for subspaces containers :)
 * @author pemanteau
 * @package Universe
 */

namespace Universe\Interfaces;

/**
 * Will be used to manipulate common attributes of universe wonders
 */
interface HasSubSpaces
{
    /**
     * Returns the collection of subspaces
     * @return \Doctrine\Common\Collections\ArrayCollection
     *     array Universe\Interfaces\IsSubSpace[]
     */
    public function getSubSpaces();

    /**
     * Adds a Universe\Interfaces\IsSubSpace to the collection of subspaces
     * @param Universe\Interfaces\IsSubSpace $subspace
     */
    public function addSubSpace(IsSubSpace $subspace);


    /**
     * The number of subspaces to be displayed per row
     * @param int $nbPerRow
     */
    public function setSubSpacesPerRow($nbPerRow);

    /**
     * The number of subspaces to be displayed per row
     * @return int
     */
    public function getSubSpacesPerRow();
}