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
 * A Universe is 1024 x 768 pixels, made out of 8x6 sectors
 * A sector is 128x128 pixels, made out of 4x4 parsecs
 * A parsec is 32x32 pixels, made out of 4x4 Artefacts
 * An artefact is 8x8 pixels, a unit of space
 *
 * An item (planet, moon, asteroid, ship, army, can be n x m artefacts big
 *
 * @ORM\Entity
 * @ORM\Table(name="universe")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Universe
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

}