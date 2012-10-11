<?php
/**
 * This class is used to handle parsecs
 * @author pemanteau
 * @package Universe
 */

namespace Universe\Entity;

use Kernel\Interfaces\Entity;
use Universe\Interfaces\IsSubSpace;
use Universe\Interfaces\HasSubSpaces;
use Universe\Interfaces\DarkMatter;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Will be used to manipulate parsecs
 * @ORM\Entity
 * @ORM\Table(name="parsec")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Parsec implements DarkMatter, HasSubSpaces, IsSubSpace, Entity
{
    /**
     * The Parsec id
     * @var Int
     * @ORM\Id @ORM\Column(name="idParsec", type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * The parsec's collection of artefacts
     * @var \Doctrine\Common\Collections\ArrayCollection
     * 		Array Universe\Entity\Artefact[]
     * @ORM\ManyToMany(
     *        targetEntity="Universe\Entity\Artefact",
     *        indexBy="id",
     *        cascade={"persist"}
     * )
     * @ORM\JoinTable(name="parsec_artefact",
     *      joinColumns={
     *      	@ORM\JoinColumn(
     *      		name="idParsec",
     *      		referencedColumnName="idParsec"
     *      	)
     *      },
     *      inverseJoinColumns={
     *      	@ORM\JoinColumn(
     *      		name="idArtefact",
     *      		referencedColumnName="idArtefact",
     *      		unique=true
     *      	)
     *      }
     * 	)
     **/
	private $artefacts;

	/**
	 * Coordinates left(x)-top(y) of the parsec
	 * This is a calculated property
	 * @var array
	 */
	private $coordinates;

	/**
	 * The size of the parsec in px
	 * @var int
	 * @ORM\Column(name="size", type="integer")
	 */
	private $size;

	/**
	 * The number of artefacts of the parsec
	 * @var int
	 * @ORM\Column(name="nbSubSpaces", type="integer")
	 */
	private $subSpacesPerRow;

	/**
	 * Constructor
	 */
	public function __construct(){
		$this->artefacts = new ArrayCollection();
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
	 * Returns an artefact for a given id
	 * @param int $id
	 * @throws \Exception
	 */
	public function getArtefactById($id)
	{
		if (empty($id)) {
			throw new Universe\Exception\DomainException(
				__METHOD__ . ' - Id should be set!'
			);
		}
		return $this->artefacts->get($id);
	}

	/**
	 * Returns a Collection of Artefacts
	 * @{inheritDoc}
	 */
	public function getSubSpaces()
	{
	    return $this->artefacts;
	}

	/**
	 * Adds an artefact to the sector
	 * @{inheritDoc}
	 */
	public function addSubSpace(IsSubSpace $subspace)
	{
	    $this->artefacts->add($subspace);
	}

	/**
	 * Calculate the parsec's position depending on :
	 *     - its position in the universe
	 *     - the cumulated coordinates of its parsecs
	 * IoC ftw!
	 * @ignore this is temp idea
	 * @param Universe\Entity\Sector $sector
	 * @return multitype:
	 */
	public function getCoordinates(Universe\Entity\Sector $sector)
	{
	    // calculates the coordinates of a parsec based upon it's parsecs
	    // cumulated coordinates and calculated position in the universe

	    // first, get the position right
	    $position = $sector->getSectorPosition($this);

	    return $this->coordinates;
	}

	/**
	 * Set the nb of artefacts of the parsec
	 * @{inheritDoc}
	 */
	public function setSubSpacesPerRow($nbPerRow)
	{
	    $this->subSpacesPerRow = $nbPerRow;
	}

	/**
	 * Returns the nb of artefacts to be displayed per row
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