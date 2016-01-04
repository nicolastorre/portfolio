<?php
namespace Portfolio\Domain\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Kernel\Entity;
use Portfolio\Domain\Model\Diploma;

/**
 * Class Exp
 * @package Portfolio\Domain\Model
 */
class Exp extends Diploma{

	/**
	 * @var int
	 */
	protected $current;

	/**
	 * @return boolean
	 */
	public function isCurrent()
	{
		return $this->current;
	}

	/**
	 * @param boolean $current
	 */
	public function setCurrent($current)
	{
		$this->current = $current;
	}

}