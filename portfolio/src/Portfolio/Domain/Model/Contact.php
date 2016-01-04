<?php
namespace Portfolio\Domain\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Kernel\Entity;

/**
 * Class Contact
 * @package Portfolio\Domain\Model
 */
class Contact extends Entity{

	/**
	 *
	 * @var integer
	 */
	protected $id;

	/**
	 *
	 * @var string
	 */
	protected $email;

	/**
	 *
	 * @var string
	 */
	protected $object;

	/*
	 *
	 * @var integer
	 */
	protected $message;

	/**
	 * @param ClassMetadata $metadata
	 */
	static public function loadValidatorMetadata(ClassMetadata $metadata)
	{
		$metadata->addPropertyConstraint('object', new Assert\NotBlank());
		$metadata->addPropertyConstraint('message', new Assert\NotBlank());
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
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getObject()
	{
		return $this->object;
	}

	/**
	 * @param string $object
	 */
	public function setObject($object)
	{
		$this->object = $object;
	}

	/**
	 * @return mixed
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * @param mixed $message
	 */
	public function setMessage($message)
	{
		$this->message = $message;
	}

}