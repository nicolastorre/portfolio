<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Portfolio\Domain\Model\Article;
use Portfolio\Classes\Form\ArticleForm;

/**
 * Class DefaultController
 * @package Portfolio\Classes\Controller
 */
class DefaultController
{
	/**
	 * upload directory
	 */
	CONST UPLOAD_DIR = '/../../../../web/upload/';

	/**
	 * article publié
	 */
	CONST ARTICLE_PUBLISHED = 1;

	/*
	 * @var repository
	 */
	protected $repository;

	/**
	 * @param array $repository
	 */
	public function __construct(Array $repository = array()) {
		$this->repository = $repository;

	}
}