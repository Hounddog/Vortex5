<?php
/**
 * This class is used to handle parsecs
 * @author pemanteau
 * @package Universe
 */

namespace Universe\Entity;

use Universe\Interfaces\DarkMatter;
use Universe\Interfaces\IsSubSpace;
use Doctrine\ORM\Mapping as ORM;

/**
 * Will be used to manipulate parsecs
 * @ORM\Entity
 * @ORM\Table(name="parsec")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Artefact implements DarkMatter, IsSubSpace
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
	 * The marvellous class to use to render this little piece of universe
	 * @var int
	 * @ORM\Column(name="cssClass", type="int")
	 */
	private $cssClass;

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

	/**
	 * The name of a css class
	 * @param string $cssClassName
	 */
	public function setCssClass($cssClassName)
	{
	    $this->cssClass = $cssClassName;
	}

	/**
	 * Returns a css class name
	 * @return string $cssClassName
	 */
	public function getCssClass()
	{
	     return $this->cssClass;
	}

}