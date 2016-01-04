<?php

namespace Portfolio\Domain\Repository;

use Doctrine\DBAL\Connection;
use Kernel\Repository;
use Portfolio\Domain\Model\Article;

/**
 * Class ArticleRepository
 * @package Portfolio\Domain\Repository
 */
class ArticleRepository extends Repository
{
	/**
	 * @param $i
	 */
	public function findLast($n = 1) {
		$sql = "select * from ".$this->tableName." order by publishedDate desc limit 3";
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
		$article = new Article();
		$article->setId($row['id']);
		$article->setTitle($row['title']);
		$article->setContent($row['content']);
		$article->setPublishedDate($row['publishedDate']);
		$article->setAuthor($row['author']);
		$article->setImage($row['image']);
		$article->setPublished($row['published']);
		return $article;
	}

}