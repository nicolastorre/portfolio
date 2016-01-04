<?php

namespace Portfolio\Domain\Repository;

use Doctrine\DBAL\Connection;
use Kernel\Repository;
use Portfolio\Domain\Model\Exp;

/**
 * Class ExpRepository
 * @package Portfolio\Domain\Repository
 */
class ExpRepository extends Repository
{

	/**
	 * Creates an Article object based on a DB row.
	 *
	 * @param array $row The DB row containing Article data.
	 * @return \Portfolio\Domain\Model\Article
	 */
	protected function buildDomainObject($row) {
		$exp = new Exp();
		$exp->setId($row['id']);
		$exp->setStartDate($row['startDate']);
		$exp->setEndDate($row['endDate']);
		$exp->setTitle($row['title']);
		$exp->setDescription($row['description']);
		$exp->setCurrent($row['current']);
		$exp->setBio($row['bio']);
		return $exp;
	}

}