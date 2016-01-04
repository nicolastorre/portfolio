<?php

namespace Portfolio\Domain\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Kernel\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package Portfolio\Domain\Model
 */
class User extends Entity implements UserInterface
{
	/**
	* User id.
	*
	* @var integer
	*/
	protected $id;

	/**
	* User name.
	*
	* @var string
	*/
	protected $username;

	/**
	* User password.
	*
	* @var string
	*/
	protected $password;

	/**
	* Salt that was originally used to encode the password.
	*
	* @var string
	*/
	protected $salt;

	/**
	* Role.
	* Values : ROLE_USER or ROLE_ADMIN.
	*
	* @var string
	*/
	protected $role;

	/**
	 * @param ClassMetadata $metadata
	 */
	static public function loadValidatorMetadata(ClassMetadata $metadata)
	{
		$metadata->addPropertyConstraint('username', new Assert\NotBlank());
		$metadata->addPropertyConstraint('username', new Assert\Length(array('min' => 5)));
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
	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @return string
	 */
	public function getSalt() {
		return $this->salt;
	}

	/**
	 * @param $salt
	 */
	public function setSalt($salt) {
		$this->salt = $salt;
	}

	/**
	 * @return string
	 */
	public function getRole() {
		return $this->role;
	}

	/**
	 * @param $role
	 */
	public function setRole($role) {
		$this->role = $role;
	}

	/**
	 * @return array
	 */
	public function getRoles() {
		return array($this->getRole());
	}

	/**
	 *
	 */
	public function eraseCredentials() {
		// Nothing to do here
	}

}