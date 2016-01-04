<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Portfolio\Domain\Model\Diploma;
use Portfolio\Classes\Form\DiplomaForm;
use Portfolio\Classes\Controller;

/**
 * Class DiplomaController
 * @package Portfolio\Classes\Controller
 */
class DiplomaController extends DefaultController
{

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $idbio
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function addAction(Request $request, Application $app, $idbio) {
		if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			$diploma = new Diploma();
			$diploma->setBio($idbio);
			$diplomaForm = $app['form.factory']->create(new DiplomaForm(), $diploma);
			$diplomaForm->handleRequest($request);
			if ($diplomaForm->isValid()) {
				$this->repository['diplomaRepository']->save($diploma);
				$app['session']->getFlashBag()->add('success', 'The diploma was successfully created.');
				return $app->redirect('/admin/bio/list');
			}
			return $app['twig']->render('Pages/Diploma/Add.html.twig', array(
					'title' => 'New diploma',
					'diplomaForm' => $diplomaForm->createView())
			);
		}
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, Application $app, $id) {
		if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			$diploma = $this->repository['diplomaRepository']->findOneById($id);
			$diplomaForm = $app['form.factory']->create(new DiplomaForm(), $diploma);
			$diplomaForm->handleRequest($request);
			if ($diplomaForm->isValid()) {
				$this->repository['diplomaRepository']->save($diploma);
				$app['session']->getFlashBag()->add('success', 'The diploma was successfully created.');
				return $app->redirect('/admin/bio/list');
			}
			return $app['twig']->render('Pages/Diploma/Add.html.twig', array(
					'title' => 'Edit diploma',
					'diplomaForm' => $diplomaForm->createView())
			);
		}
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, Application $app, $id) {
		$deleteForm = $this->deleteForm($app, 'deleteArticle');
		$deleteForm->handleRequest($request);
		if ($deleteForm->isValid()) {
			$data = $deleteForm->getData();
			$this->repository['diplomaRepository']->delete($data['id']);
			$app['session']->getFlashBag()->add('success', 'The diploma was successfully removed.');
			return $app->redirect('/admin/bio/list');
		}
	}

}