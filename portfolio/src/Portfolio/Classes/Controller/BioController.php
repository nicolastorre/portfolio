<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Form\Form;
use Gregwar\Image\Image;
use Portfolio\Domain\Model\Bio;
use Portfolio\Classes\Form\BioForm;
use Portfolio\Classes\Controller;

/**
 * Class BioController
 * @package Portfolio\Classes\Controller
 */
class BioController extends DefaultController
{

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function indexAction(Request $request, Application $app) {

		$bio = current($this->repository['bioRepository']->findAll());

		return $app['twig']->render('Pages/Bio/Index.html.twig', array(
			'bio' => $bio,
		));
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function listAction(Request $request, Application $app) {

		$bio = $this->repository['bioRepository']->findAll();

		return $app['twig']->render('Pages/Bio/List.html.twig', array(
			'bio' => current($bio),
		));
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function addAction(Request $request, Application $app) {

		$bio = new Bio();
		$bioForm = $app['form.factory']->create(new BioForm(), $bio);
		$bioForm->handleRequest($request);
		if ($bioForm->isValid()) {
			$filename = $this->upload($request, $bioForm, 120, 120);
			$bio->setImage($filename);

			$this->repository['bioRepository']->save($bio);
			$app['session']->getFlashBag()->add('success', 'The bio was successfully created.');
			return $app->redirect($app["url_generator"]->generate('listBio'));
		}
		return $app['twig']->render('Pages/Bio/Add.html.twig', array(
				'title' => 'New diploma',
				'bioForm' => $bioForm->createView())
		);
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, Application $app, $id) {

		$bio = $this->repository['bioRepository']->findOneById($id);
		$oldImage = $bio->getImage();
		$bioForm = $app['form.factory']->create(new BioForm(), $bio);
		$bioForm->handleRequest($request);
		if ($bioForm->isValid()) {
			$filename = $this->upload($request, $bioForm, 120, 120);
			if(false !== $filename) {
				$this->deleteFile($oldImage);
				$bio->setImage($filename);
			} else {
				$bio->setImage($oldImage);
			}

			$this->repository['bioRepository']->save($bio);
			$app['session']->getFlashBag()->add('success', 'The bio was successfully created.');
			return $app->redirect($app["url_generator"]->generate('listBio'));
		}
		return $app['twig']->render('Pages/Bio/Add.html.twig', array(
				'title' => 'Edit bio',
				'bioForm' => $bioForm->createView())
		);
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, Application $app, $id) {

		throw new AccessDeniedException();
	}

}