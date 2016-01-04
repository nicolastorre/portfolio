<?php
namespace Kernel;

use Doctrine\DBAL\Connection;
use Silex\Application;

/**
 * Class Entity
 * @package Kernel
 */
abstract class Entity
{

	/**
	 * Retourne les propriétés d'un objet
	 *
	 * @return array
	 */
	public function getProperties() {
		return get_object_vars($this);
	}
}