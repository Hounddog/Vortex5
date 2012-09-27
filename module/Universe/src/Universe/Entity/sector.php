<?php
/**
 * This class is used to handle sectors
 * @author pemanteau
 * @package Universe
 */

namespace Universe\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Will be used to manipulate sectors
 * @ORM\Entity
 * @ORM\Table(name="sector")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Sector
{
    /**
     * The Sector id
     * @var Int
     * @ORM\Id @ORM\Column(name="idSector", type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * The sector's collection of parsecs
     * @var \Doctrine\Common\Collections\ArrayCollection
     * 		Array Universe\Entity\Parsec[]
     * @ORM\ManyToMany(
     * 		targetEntity="Universe\Entity\Parsec", indexBy="id"
     * )
     * @ORM\JoinTable(name="sector_parsec",
     *      joinColumns={
     *      	@ORM\JoinColumn(
     *      		name="idSector",
     *      		referencedColumnName="idSector"
     *      	)
     *      },
     *      inverseJoinColumns={
     *      	@ORM\JoinColumn(
     *      		name="idParsec",
     *      		referencedColumnName="idParsec",
     *      		unique=true
     *      	)
     *      }
     * 	)
     **/
	private $parsecs;

	/**
	 * Coordinates left(x)-top(y) of the sector
	 * This is a calculated property
	 * @var array
	 */
	private $coordinates;

	/**
	 * Constructor
	 */
	public function __constructor(){
		$this->parsecs = new \Doctrine\Common\Collection\ArrayCollection();
	}

	/**
	 * Returns a parsec for a given id
	 * @param int $id
	 * @throws \Exception
	 */
	public function getParsecById($id)
	{
		if (empty($id)) {
			throw new \Exception(
				'[\Core\Universe\Sector](getParsecById) - Id should be set!'
			);
		}
		return $this->parsecs->get($id);
	}

	/**
	 * Calculate the sector's position depending on :
	 *     - its position in the universe
	 *     - the cumulated coordinates of its parsecs
	 * IoC ftw!
	 * @ignore this is temp idea
	 * @param Universe\Entity\Universe $universe
	 * @return multitype:
	 */
	public function getCoordinates(Universe\Entity\Universe $universe)
	{
	    // calculates the coordinates of a sector based upon it's parsecs
	    // cumulated coordinates and calculated position in the universe

	    // first, get the position right
	    $position = $universe->getSectorPosition($this);

	    return $this->coordinates;
	}

}