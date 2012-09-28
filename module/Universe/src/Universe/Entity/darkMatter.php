<?php
/**
 * This class is used to handle DarkMatters of the universe :)
* @author pemanteau
* @package Universe
*/

namespace Universe\Entity;

/**
 * Will be used to manipulate common attributes of universe wonders
 */
interface DarkMatter
{
	/**
	 * Set the size of the universe in px
	 * @param int $size
	 */
	public function setSize($size);
}