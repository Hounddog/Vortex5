<?php
/**
 * This class is used to handle universes
 * @author pemanteau
 * @package Universe
 */

namespace Universe\Entity;

use ZendTest\I18n\Validator\IntTest;

use Doctrine\ORM\Mapping as ORM;

/**
 * Will be used to manipulate universes, yeah that totally sounds EPIC!
 *
 * A Universe is 800 x 800 pixels, made out of 5x5 sectors
 * A sector is 160x160 pixels, made out of 5x5 parsecs
 * A parsec is 32x32 pixels, made out of 4x4 Artefacts
 * An artefact is 8x8 pixels, a unit of space
 *
 * 5 x 5 x 4
 * 5 x 5 x 4
 *
 * 800 x 800 => 5 x 5 (160px² each) => 5 x 5 (32px² each) => 4 x 4 (8px² each)
 *
 * An item (planet, moon, asteroid, ship, army) can be n x m artefacts big
 *
 * @ORM\Entity
 * @ORM\Table(name="universe")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Universe implements DarkMatter
{
    /**
     * The Universe id
     * @var Int
     * @ORM\Id @ORM\Column(name="idUniverse", type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

	/**
	 * The universe's collection of sectors
	 * @var \Doctrine\Common\Collections\ArrayCollection
     * 		Array Universe\Entity\Sector[]
     * @ORM\ManyToMany(
     * 		targetEntity="Universe\Entity\Sector", indexBy="id"
     * )
     * @ORM\JoinTable(name="universe_sector",
     *      joinColumns={
     *      	@ORM\JoinColumn(
     *      		name="idUniverse",
     *      		referencedColumnName="idUniverse"
     *      	)
     *      },
     *      inverseJoinColumns={
     *      	@ORM\JoinColumn(
     *      		name="idSector",
     *      		referencedColumnName="idSector",
     *      		unique=true
     *      	)
     *      }
     * 	)
     **/
	private $sectors;

	/**
	 * The size of the universe, in lightyears of course :) px
	 * @var int
	 * @ORM\Column(name="size", type="int")
	 */
	private $size;

	/**
	 * The number of sectors of the universe
	 * @var int
	 * @ORM\Column(name="nbSectors", type="int")
	 */
	private $nbSectors;

	/**
	 * Constructor
	 */
	public function __constructor(){
		$this->sectors = new \Doctrine\Common\Collection\ArrayCollection();
	}

	/**
	 * Returns a sector for a given id
	 * @param int $id
	 * @throws \Exception
	 */
	public function getSectorById($id)
	{
		if (empty($id)) {
			throw new \Exception(
				'[\Core\Universe\Universe](getSectorById) - Id should be set!'
			);
		}
		return $this->sectors->get($id);
	}

	/**
	 * Adds a sector to the universe
	 * @param Universe\Entity\Sector $sector
	 */
	public function addSector(Universe\Entity\Sector $sector)
	{
	    $this->sectors->add($sector);
	}

	/**
	 * Set the nb of sectors of the universe
	 * @param int $nbSectors
	 */
	public function setNbSectors($nbSectors)
	{
	    $this->nbSectors = $nbSectors;
	}

	/**
	 * Set the size of the universe in px
	 * @param int $size
     * @{inheritDoc}
	 */
	public function setSize($size)
	{
	    $this->size = $size;
	}

}