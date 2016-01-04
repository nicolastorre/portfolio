<?php
namespace Portfolio\Domain\Repository;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use Kernel\Repository;

use Portfolio\Domain\Model\User;

/**
 * Class UserRepository
 * @package Portfolio\Domain\Repository
 */
class UserRepository extends Repository implements UserProviderInterface
{

	/**
	 * @param string $username
	 * @return User
	 */
	public function loadUserByUsername($username)
	{
		$sql = "select * from ".$this->tableName." where username = :username";
		$row = $this->db->fetchAssoc($sql, array('username' => $username));

		if ($row)
			return $this->buildDomainObject($row);
		else
			throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
	}

	/**
	 * @param UserInterface $user
	 * @return User
	 */
	public function refreshUser(UserInterface $user)
	{
		$class = get_class($user);
		if (!$this->supportsClass($class)) {
			throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
		}
		return $this->loadUserByUsername($user->getUsername());
	}

	/**
	 * @param string $class
	 * @return bool
	 */
	public function supportsClass($class)
	{
		return 'Portfolio\Domain\Model\User' === $class;
	}

	/**
	 * Creates a User object based on a DB row.
	 *
	 * @param array $row The DB row containing User data.
	 * @return \Portfolio\Domain\Model\User
	 */
	protected function buildDomainObject($row) {
		$user = new User();
		$user->setId($row['id']);
		$user->setUsername($row['username']);
		$user->setPassword($row['password']);
		$user->setSalt($row['salt']);
		$user->setRole($row['role']);
		return $user;
	}

}