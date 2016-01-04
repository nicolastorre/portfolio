<?php
namespace Portfolio\Domain\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Kernel\Entity;

/**
 * Class Interest
 * @package Portfolio\Domain\Model
 */
class Interest extends Entity{

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

	/**
	 *
	 * @var Bio
	 */
	protected $bio;

	/**
	 * @param ClassMetadata $metadata
	 */
	static public function loadValidatorMetadata(ClassMetadata $metadata)
	{
		$metadata->addPropertyConstraint('label', new Assert\NotBlank());
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
	 * @return Bio
	 */
	public function getBio()
	{
		return $this->bio;
	}

	/**
	 * @param Bio $bio
	 */
	public function setBio($bio)
	{
		$this->bio = $bio;
	}

}