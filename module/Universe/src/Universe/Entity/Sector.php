<?php
/**
 * This class is used to handle sectors
 * @author pemanteau
 * @package Universe
 */

namespace Universe\Entity;

use Kernel\Interfaces\Entity;
use Universe\Interfaces\IsSubSpace;
use Universe\Interfaces\DarkMatter;
use Universe\Interfaces\HasSubSpaces;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Will be used to manipulate sectors
 * @ORM\Entity
 * @ORM\Table(name="sector")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Sector implements DarkMatter, HasSubSpaces, IsSubSpace, Entity
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
     *        targetEntity="Universe\Entity\Parsec",
     *        indexBy="id",
     *        cascade={"persist"}
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
	 * The size of the sector in px
	 * @var int
	 * @ORM\Column(name="size", type="integer")
	 */
	private $size;

	/**
	 * The number of parsecs of the sector
	 * @var int
	 * @ORM\Column(name="nbSubSpaces", type="integer")
	 */
	private $subSpacesPerRow;

	/**
	 * Constructor
	 */
	public function __construct(){
		$this->parsecs = new ArrayCollection();
	}

	/**
	 * Get the id of the Entity
	 * @return int
	 */
	public function getId()
	{
	    return $this->id;
	}

	/**
	 * Set the id of the Entity
	 * @param int $id
	 */
	public function setId($id)
	{
	    $this->id = $id;
	}

	/**
	 * Returns a parsec for a given id
	 * @param int $id
	 * @throws \Exception
	 */
	public function getParsecById($id)
	{
		if (empty($id)) {
			throw new Universe\Exception\DomainException(
				__METHOD__ . ' - Id should be set!'
			);
		}
		return $this->parsecs->get($id);
	}

	/**
	 * Returns a Collection of Parsecs
	 * @{inheritDoc}
	 */
	public function getSubSpaces()
	{
	    return $this->parsecs;
	}

	/**
	 * Adds a parsec to the sector
	 * @{inheritDoc}
	 */
	public function addSubSpace(IsSubSpace $subspace)
	{
	    $this->parsecs->add($subspace);
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

	/**
	 * Set the nb of sectors of the sector
	 * @{inheritDoc}
	 */
	public function setSubSpacesPerRow($nbPerRow)
	{
	    $this->subSpacesPerRow = $nbPerRow;
	}

	/**
	 * Returns the nb of parsecs to be displayed per row
 	 * @{inheritDoc}
	 */
	public function getSubSpacesPerRow()
	{
	    return $this->subSpacesPerRow;
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

	/**
	 * Returns the size of the entity
	 * @{inheritDoc}
	 */
	public function getSize()
	{
	    return $this->size;
	}

}