<?php
/**
 * This class is used to handle parsecs
 * @author pemanteau
 * @package Universe
 */

namespace Universe\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Will be used to manipulate parsecs
 * @ORM\Entity
 * @ORM\Table(name="parsec")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Parsec implements DarkMatter
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
     * 		targetEntity="Universe\Entity\Artefact", indexBy="id"
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
	 * @ORM\Column(name="size", type="int")
	 */
	private $size;

	/**
	 * The number of artefacts of the parsec
	 * @var int
	 * @ORM\Column(name="nbArtefacts", type="int")
	 */
	private $nbArtefacts;

	/**
	 * Constructor
	 */
	public function __constructor(){
		$this->artefacts = new \Doctrine\Common\Collection\ArrayCollection();
	}

	/**
	 * Returns an artefact for a given id
	 * @param int $id
	 * @throws \Exception
	 */
	public function getArtefactById($id)
	{
		if (empty($id)) {
			throw new \Exception(
				'[\Core\Universe\Parsec](getArtefactById) - Id should be set!'
			);
		}
		return $this->artefacts->get($id);
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
	 * Set the nb of parsecs of the universe
	 * @param int $nbArtefacts
	 */
	public function setNbArtefacts($nbArtefacts)
	{
	    $this->nbArtefacts = $nbArtefacts;
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