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
class Artefact implements DarkMatter
{
    /**
     * The Parsec id
     * @var Int
     * @ORM\Id @ORM\Column(name="idArtefact", type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

	/**
	 * Coordinates left(x)-top(y) of the artefact
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
	 * Set the size of the universe in px
	 * @param int $size
	 * @{inheritDoc}
	 */
	public function setSize($size)
	{
	    $this->size = $size;
	}

}