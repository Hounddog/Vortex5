<?php
/**
 * This class is used to handle DarkMatters of the universe :)
* @author pemanteau
* @package Universe
*/

namespace Kernel\Interfaces;

/**
 * Will be used to manipulate common attributes of universe wonders
 */
interface Entity
{
	/**
	 * get the id of the Entity
	 * @return mixed
	 */
	public function getId();

	/**
	 * Sets the id of an Entity
	 * @param mixed $id
	 */
	public function setId($id);
}