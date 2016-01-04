<?php

namespace Portfolio\Domain\Repository;

use Doctrine\DBAL\Connection;
use Kernel\Repository;
use Portfolio\Domain\Model\Diploma;

/**
 * Class DiplomaRepository
 * @package Portfolio\Domain\Repository
 */
class DiplomaRepository extends Repository {

	/**
	 * Creates an Article object based on a DB row.
	 *
	 * @param array $row The DB row containing Article data.
	 * @return \Portfolio\Domain\Model\Article
	 */
	protected function buildDomainObject($row) {
		$diploma = new Diploma();
		$diploma->setId($row['id']);
		$diploma->setStartDate($row['startDate']);
		$diploma->setEndDate($row['endDate']);
		$diploma->setTitle($row['title']);
		$diploma->setDescription($row['description']);
		$diploma->setBio($row['bio']);
		return $diploma;
	}

}