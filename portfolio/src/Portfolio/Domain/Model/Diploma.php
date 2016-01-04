<?php
namespace Portfolio\Domain\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Kernel\Entity;

/**
 * Class Diploma
 * @package Portfolio\Domain\Model
 */
class Diploma extends Entity {
	/**
	 * Article id.
	 *
	 * @var integer
	 */
	protected $id;

	/**
	 * Diploma startDate.
	 *
	 * @var string
	 */
	protected $startDate;

	/**
	 * Diploma endDate
	 *
	 * @var string
	 */
	protected $endDate;

	/**
	 * Article content.
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var integer
	 */
	protected $bio;

	/**
	 * @param ClassMetadata $metadata
	 */
	static public function loadValidatorMetadata(ClassMetadata $metadata)
	{
		$metadata->addPropertyConstraint('title', new Assert\NotBlank());
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getStartDate()
	{
		return $this->startDate;
	}

	/**
	 * @param string $startDate
	 */
	public function setStartDate($startDate)
	{
		$this->startDate = $startDate;
	}

	/**
	 * @return string
	 */
	public function getEndDate()
	{
		return $this->endDate;
	}

	/**
	 * @param string $endDate
	 */
	public function setEndDate($endDate)
	{
		$this->endDate = $endDate;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 * @return integer
	 */
	public function getBio()
	{
		return $this->bio;
	}

	/**
	 * @param integer $bio
	 */
	public function setBio($bio)
	{
		$this->bio = $bio;
	}

}