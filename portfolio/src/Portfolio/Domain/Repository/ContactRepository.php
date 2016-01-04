<?php

namespace Portfolio\Domain\Repository;

use Doctrine\DBAL\Connection;
use Kernel\Repository;
use Portfolio\Domain\Model\Contact;

/**
 * Class ContactRepository
 * @package Portfolio\Domain\Repository
 */
class ContactRepository extends Repository
{

	/**
	 * Creates an Article object based on a DB row.
	 *
	 * @param array $row The DB row containing Article data.
	 * @return \Portfolio\Domain\Model\Article
	 */
	protected function buildDomainObject($row) {
		$contact = new Contact();
		$contact->setId($row['id']);
		$contact->setEmail($row['email']);
		$contact->setObject($row['object']);
		$contact->setMessage($row['message']);
		return $contact;
	}

}