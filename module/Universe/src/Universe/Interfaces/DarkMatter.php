<?php
/**
 * This class is used to handle DarkMatters of the universe :)
* @author pemanteau
* @package Universe
*/

namespace Universe\Interfaces;

/**
 * Will be used to manipulate common attributes of universe wonders
 */
interface DarkMatter
{
	/**
	 * Set the size of the entity in px
	 * @param int $size
	 */
	public function setSize($size);

	/**
	 * Returns the size of the entity in px
	 * @return int
	 */
	public function getSize();

}