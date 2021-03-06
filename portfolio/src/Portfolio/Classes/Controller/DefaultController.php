<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Portfolio\Domain\Model\Article;
use Portfolio\Classes\Form\ArticleForm;
use Symfony\Component\Form\Form;
use Gregwar\Image\Image;

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

	// @ToDo delete image method with unlink function
	protected function deleteFile($filename) {
		$path = __DIR__ . self::UPLOAD_DIR;
		$filepath = $path . $filename;
		@chmod($filepath, 0755);
		@unlink($filepath);
		return TRUE;
	}

	/**
	 * @param Request $request
	 * @param Form $articleForm
	 * @return mixed
	 * @throws \Exception
	 */
	protected function upload(Request $request, Form $form, $width, $height) {
		$files = $request->files->get($form->getName());
		if(!empty($files['image'])) {
			$path = __DIR__ . self::UPLOAD_DIR;
			$filename = $files['image']->getClientOriginalName();
			$filepath = $path . $filename;
			$files['image']->move($path, $filename);
			chmod($filepath, 0755);

			//ToDo: renommer les images en ajoutant uniqid()

			Image::open($filepath)
				->zoomCrop($width, $height, "#346A85", "center", "center")
				->save($filepath);

			return $filename;
		} else {
			return false;
		}
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