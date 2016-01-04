<?php

namespace Portfolio\Domain\Repository;

use Doctrine\DBAL\Connection;
use Kernel\Repository;
use Portfolio\Domain\Model\Skill;

/**
 * Class SkillRepository
 * @package Portfolio\Domain\Repository
 */
class SkillRepository extends Repository
{

	/**
	 * Creates an Article object based on a DB row.
	 *
	 * @param array $row The DB row containing Article data.
	 * @return \Portfolio\Domain\Model\Article
	 */
	protected function buildDomainObject($row) {
		$skill = new Skill();
		$skill->setId($row['id']);
		$skill->setLabel($row['label']);
		$skill->setLink($row['link']);
		$skill->setLevel($row['level']);
		$skill->setBio($row['bio']);
		return $skill;
	}

}