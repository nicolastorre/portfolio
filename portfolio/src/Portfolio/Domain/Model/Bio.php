<?php
namespace Portfolio\Domain\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Kernel\Entity;

/**
 * Class Bio
 * @package Portfolio\Domain\Model
 */
class Bio extends Entity {
	/**
	 * Article id.
	 *
	 * @var integer
	 */
	protected $id;

	/**
	 * Article title.
	 *
	 * @var string
	 */
	protected $firstName;

	/**
	 * Article title.
	 *
	 * @var string
	 */
	protected $lastName;

	/**
	 * @var string
	 */
	protected $presentation;

	/**
	 * @var string
	 */
	protected $image;

	/**
	 * @var Diploma
	 */
	private $diploma;

	/**
	 * @var Exp
	 */
	private $exp;

	/**
	 * @var Skill
	 */
	private $skill;

	/**
	 * @var Interest
	 */
	private $interest;

	/**
	 * @param ClassMetadata $metadata
	 */
	static public function loadValidatorMetadata(ClassMetadata $metadata)
	{
		$metadata->addPropertyConstraint('firstName', new Assert\NotBlank());
		$metadata->addPropertyConstraint('lastName', new Assert\NotBlank());
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
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @param string $firstname
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @param string $lastname
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getPresentation()
	{
		return $this->presentation;
	}

	/**
	 * @param string $presentation
	 */
	public function setPresentation($presentation)
	{
		$this->presentation = $presentation;
	}

	/**
	 * @return string
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * @param string $image
	 */
	public function setImage($image)
	{
		$this->image = $image;
	}

	/**
	 * @return Diploma
	 */
	public function getDiploma()
	{
		return $this->diploma;
	}

	/**
	 * @param Diploma $diploma
	 */
	public function setDiploma($diploma)
	{
		$this->diploma = $diploma;
	}

	/**
	 * @return Exp
	 */
	public function getExp()
	{
		return $this->exp;
	}

	/**
	 * @param Exp $exp
	 */
	public function setExp($exp)
	{
		$this->exp = $exp;
	}

	/**
	 * @return Skill
	 */
	public function getSkill()
	{
		return $this->skill;
	}

	/**
	 * @param Skill $skill
	 */
	public function setSkill($skill)
	{
		$this->skill = $skill;
	}

	/**
	 * @return Interest
	 */
	public function getInterest()
	{
		return $this->interest;
	}

	/**
	 * @param Interest $interest
	 */
	public function setInterest($interest)
	{
		$this->interest = $interest;
	}

}