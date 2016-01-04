<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Portfolio\Domain\Model\Interest;
use Portfolio\Classes\Form\InterestForm;
use Portfolio\Classes\Controller;

/**
 * Class InterestController
 * @package Portfolio\Classes\Controller
 */
class InterestController extends DefaultController
{

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $idbio
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function addAction(Request $request, Application $app, $idbio) {
		if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			$interest = new Interest();
			$interest->setBio($idbio);
			$interestForm = $app['form.factory']->create(new InterestForm(), $interest);
			$interestForm->handleRequest($request);
			if ($interestForm->isValid()) {
				$this->repository['interestRepository']->save($interest);
				$app['session']->getFlashBag()->add('success', 'The interest was successfully created.');
				return $app->redirect('/admin/bio/list');
			}
			return $app['twig']->render('Pages/Interest/Add.html.twig', array(
					'title' => 'New interest',
					'interestForm' => $interestForm->createView())
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
			$interest = $this->repository['interestRepository']->findOneById($id);
			$interestForm = $app['form.factory']->create(new InterestForm(), $interest);
			$interestForm->handleRequest($request);
			if ($interestForm->isValid()) {
				$this->repository['interestRepository']->save($interest);
				$app['session']->getFlashBag()->add('success', 'The interest was successfully created.');
				return $app->redirect('/admin/bio/list');
			}
			return $app['twig']->render('Pages/Interest/Add.html.twig', array(
					'title' => 'Edit interest',
					'interestForm' => $interestForm->createView())
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
		if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			$this->repository['interestRepository']->delete($id);
			$app['session']->getFlashBag()->add('success', 'The interest was successfully removed.');
			return $app->redirect('/admin/bio/list');
		}
	}

}