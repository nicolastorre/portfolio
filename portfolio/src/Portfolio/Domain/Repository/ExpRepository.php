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
	 * @param $bio
	 */
	public function findByBioOrderByDate($bio) {
		$sql = "select * from ".$this->tableName." where bio = $bio order by startDate desc ";
		$result = $this->db->fetchAll($sql);

		// Convert query result to an array of objects
		$objectList = array();
		foreach ($result as $row) {
			$id = $row['id'];
			$objectList[$id] = $this->buildDomainObject($row);
		}

		return $objectList;
	}

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