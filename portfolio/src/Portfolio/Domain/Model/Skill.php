<?php
namespace Portfolio\Domain\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Kernel\Entity;

/**
 * Class Skill
 * @package Portfolio\Domain\Model
 */
class Skill extends Entity{

	/**
	 *
	 * @var integer
	 */
	protected $id;

	/**
	 *
	 * @var string
	 */
	protected $label;

	/**
	 *
	 * @var string
	 */
	protected $link;

	/*
	 *
	 * @var integer
	 */
	protected $level;

	/**
	 *
	 * @var integer
	 */
	protected $bio;

	/**
	 * @param ClassMetadata $metadata
	 */
	static public function loadValidatorMetadata(ClassMetadata $metadata)
	{
		$metadata->addPropertyConstraint('label', new Assert\NotBlank());
		$metadata->addPropertyConstraint('link', new Assert\NotBlank());
		$metadata->addPropertyConstraint('level', new Assert\NotBlank());
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * @param string $label
	 */
	public function setLabel($label)
	{
		$this->label = $label;
	}

	/**
	 * @return string
	 */
	public function getLink()
	{
		return $this->link;
	}

	/**
	 * @param string $link
	 */
	public function setLink($link)
	{
		$this->link = $link;
	}

	/**
	 * @return mixed
	 */
	public function getLevel()
	{
		return $this->level;
	}

	/**
	 * @param mixed $level
	 */
	public function setLevel($level)
	{
		$this->level = $level;
	}

	/**
	 * @return int
	 */
	public function getBio()
	{
		return $this->bio;
	}

	/**
	 * @param int $bio
	 */
	public function setBio($bio)
	{
		$this->bio = $bio;
	}

}