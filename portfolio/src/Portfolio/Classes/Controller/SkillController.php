<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Portfolio\Domain\Model\Skill;
use Portfolio\Classes\Form\SkillForm;
use Portfolio\Classes\Controller;

/**
 * Class SkillController
 * @package Portfolio\Classes\Controller
 */
class SkillController extends DefaultController
{

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $idbio
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function addAction(Request $request, Application $app, $idbio) {

		$skill = new skill();
		$skill->setBio($idbio);
		$skillForm = $app['form.factory']->create(new SkillForm(), $skill);
		$skillForm->handleRequest($request);
		if ($skillForm->isValid()) {
			$this->repository['skillRepository']->save($skill);
			$app['session']->getFlashBag()->add('success', 'The skill was successfully created.');
			return $app->redirect($app["url_generator"]->generate('listBio'));
		}
		return $app['twig']->render('Pages/Skill/Add.html.twig', array(
				'title' => 'New skill',
				'skillForm' => $skillForm->createView())
		);
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, Application $app, $id) {

		$skill = $this->repository['skillRepository']->findOneById($id);
		$skillForm = $app['form.factory']->create(new SkillForm(), $skill);
		$skillForm->handleRequest($request);
		if ($skillForm->isValid()) {
			$this->repository['skillRepository']->save($skill);
			$app['session']->getFlashBag()->add('success', 'The skill was successfully created.');
			return $app->redirect($app["url_generator"]->generate('listBio'));
		}
		return $app['twig']->render('Pages/Skill/Add.html.twig', array(
				'title' => 'Edit skill',
				'skillForm' => $skillForm->createView())
		);
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, Application $app) {

		$deleteForm = $this->deleteForm($app, 'deleteArticle');
		$deleteForm->handleRequest($request);
		if ($deleteForm->isValid()) {
			$data = $deleteForm->getData();
			$this->repository['skillRepository']->delete($data['id']);
			$app['session']->getFlashBag()->add('success', 'The skill was successfully removed.');
			return $app->redirect($app["url_generator"]->generate('listBio'));
		}
	}

}