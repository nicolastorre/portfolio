<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
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

	public function checkAuthenticatedUser(Application $app) {
		if (!$app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw new AccessDeniedException();
		}
	}

	public function checkAdminUser(Application $app) {

		if (!$app['security']->isGranted('ROLE_ADMIN')) {
			throw new AccessDeniedException();
		}
	}

	public function isAdminUser(Application $app) {
		if ($app['security']->isGranted('ROLE_ADMIN')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkCurrentUser(Application $app, User $user) {

		if($user->getId() != $app['security']->getToken()->getUser()->getId()) {
			throw new AccessDeniedException();
		}

	}

	protected function deleteForm(Application $app, $route, $id = NULL) {

		$data = array(
			'id' => $id
		);
		return $app['form.factory']->createBuilder('form', $data)
			->setAction($app["url_generator"]->generate($route))
			->add('id', 'hidden')
			->add('delete', 'submit')
			->getForm();
	}
}