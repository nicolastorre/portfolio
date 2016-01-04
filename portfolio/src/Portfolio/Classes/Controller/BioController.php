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
	 * @param Form $bioForm
	 * @return mixed
	 * @throws \Exception
	 */
	private function upload(Request $request, Form $bioForm) {
		$files = $request->files->get($bioForm->getName());
		$path = __DIR__.self::UPLOAD_DIR;
		$filename = $files['image']->getClientOriginalName();
		$filepath = $path.$filename;
		$files['image']->move($path,$filename);
		chmod($filepath, 0755);

		Image::open($filepath)
			->zoomCrop(120, 120,"#346A85","center","center")
			->save($filepath);

		return $filename;
	}

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
		var_dump($bio);

		return $app['twig']->render('Pages/Bio/List.html.twig', array(
			'bio' => $bio,
		));
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function addAction(Request $request, Application $app) {
		/*if (!$app['security']->isGranted('ROLE_ADMIN')) {
			throw new AccessDeniedException();
		}*/
		if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			$bio = new Bio();
			$bioForm = $app['form.factory']->create(new BioForm(), $bio);
			$bioForm->handleRequest($request);
			if ($bioForm->isValid()) {
				$filename = $this->upload($request, $bioForm);
				$bio->setImage($filename);

				$this->repository['bioRepository']->save($bio);
				$app['session']->getFlashBag()->add('success', 'The bio was successfully created.');
				return $app->redirect('/admin/bio/list');
			}
			return $app['twig']->render('Pages/Bio/Add.html.twig', array(
					'title' => 'New diploma',
					'bioForm' => $bioForm->createView())
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
		/*if (!$app['security']->isGranted('ROLE_ADMIN')) {
			throw new AccessDeniedException();
		}*/
		if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			$bio = $this->repository['bioRepository']->findOneById($id);
			$bioForm = $app['form.factory']->create(new BioForm(), $bio);
			$bioForm->handleRequest($request);
			if ($bioForm->isValid()) {
				if($bio->getImage() !== NULL) {
					$filename = $this->upload($request, $bioForm);
					$bio->setImage($filename);
				}

				$this->repository['bioRepository']->save($bio);
				$app['session']->getFlashBag()->add('success', 'The bio was successfully created.');
				return $app->redirect('/admin/bio/list');
			}
			return $app['twig']->render('Pages/Bio/Add.html.twig', array(
					'title' => 'Edit bio',
					'bioForm' => $bioForm->createView())
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
			$this->repository['bioRepository']->delete($data['id']);
			$app['session']->getFlashBag()->add('success', 'The bio was successfully removed.');
			return $app->redirect('/admin/bio/list');
		}
	}

}