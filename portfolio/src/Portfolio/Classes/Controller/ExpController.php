<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Portfolio\Domain\Model\Exp;
use Portfolio\Classes\Form\ExpForm;
use Portfolio\Classes\Controller;

/**
 * Class ExpController
 * @package Portfolio\Classes\Controller
 */
class ExpController extends DefaultController
{

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $idbio
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function addAction(Request $request, Application $app, $idbio) {
		if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			$exp = new exp();
			$exp->setBio($idbio);
			$expForm = $app['form.factory']->create(new ExpForm(), $exp);
			$expForm->handleRequest($request);
			if ($expForm->isValid()) {
				$app['expRepository']->save($exp);
				$app['session']->getFlashBag()->add('success', 'The exp was successfully created.');
				return $app->redirect('/admin/bio/list');
			}
			return $app['twig']->render('Pages/Exp/Add.html.twig', array(
					'title' => 'New exp',
					'expForm' => $expForm->createView())
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
			$exp = $app['expRepository']->findOneById($id);
			$expForm = $app['form.factory']->create(new ExpForm(), $exp);
			$expForm->handleRequest($request);
			if ($expForm->isValid()) {
				$app['expRepository']->save($exp);
				$app['session']->getFlashBag()->add('success', 'The exp was successfully created.');
				return $app->redirect('/admin/bio/list');
			}
			return $app['twig']->render('Pages/Exp/Add.html.twig', array(
					'title' => 'Edit exp',
					'expForm' => $expForm->createView())
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
			$app['expRepository']->delete($id);
			$app['session']->getFlashBag()->add('success', 'The exp was successfully removed.');
			return $app->redirect('/admin/bio/list');
		}
	}

}