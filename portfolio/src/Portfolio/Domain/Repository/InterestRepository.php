<?php

namespace Portfolio\Domain\Repository;

use Doctrine\DBAL\Connection;
use Kernel\Repository;
use Portfolio\Domain\Model\Interest;

/**
 * Class InterestRepository
 * @package Portfolio\Domain\Repository
 */
class InterestRepository extends Repository
{

	/**
	 * Creates an Article object based on a DB row.
	 *
	 * @param array $row The DB row containing Article data.
	 * @return \Portfolio\Domain\Model\Article
	 */
	protected function buildDomainObject($row) {
		$interest = new Interest();
		$interest->setId($row['id']);
		$interest->setLabel($row['label']);
		$interest->setLink($row['link']);
		$interest->setBio($row['bio']);
		return $interest;
	}

}