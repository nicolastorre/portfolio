<?php

namespace Portfolio\Domain\Repository;

use Doctrine\DBAL\Connection;
use Kernel\Repository;
use Portfolio\Domain\Model\Bio;
use Portfolio\Domain\Model\Diploma;
use Portfolio\Domain\Repository\DiplomaRepository;

/**
 * Class BioRepository
 * @package Portfolio\Domain\Repository
 */
class BioRepository extends Repository
{

	/**
	 * Creates an Article object based on a DB row.
	 *
	 * @param array $row The DB row containing Article data.
	 * @return \Portfolio\Domain\Model\Article
	 */
	protected function buildDomainObject($row) {
		$bio = new bio();
		$bio->setId($row['id']);
		$bio->setLastName($row['lastName']);
		$bio->setFirstName($row['firstName']);
		$bio->setPresentation($row['presentation']);
		$bio->setImage($row['image']);

		$diplomas = $this->repository['diplomaRepository']->findByBio($bio->getId());
		$bio->setDiploma($diplomas);

		$exps = $this->repository['expRepository']->findByBio($bio->getId());
		$bio->setExp($exps);

		$skills = $this->repository['skillRepository']->findByBio($bio->getId());
		$bio->setSkill($skills);

		$interests = $this->repository['interestRepository']->findByBio($bio->getId());
		$bio->setInterest($interests);
		return $bio;
	}

}