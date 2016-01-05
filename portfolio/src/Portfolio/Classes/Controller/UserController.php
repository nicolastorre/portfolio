<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Portfolio\Domain\Model\User;
use Portfolio\Classes\Form\UserForm;
use Portfolio\Classes\Form\UserPasswordForm;
use Portfolio\Classes\Controller;

/**
 * Class UserController
 * @package Portfolio\Classes\Controller
 */
class UserController extends DefaultController
{
	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function listAction(Request $request, Application $app) {

		$users = $this->repository['userRepository']->findAll();

		return $app['twig']->render('Pages/User/List.html.twig', array(
			'users' => $users
		));
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function addAction(Request $request, Application $app) {

		$user = new user();
		$userForm = $app['form.factory']->create(new UserForm(), $user);
		$userForm->handleRequest($request);
		if ($userForm->isValid()) {
			$salt = substr(md5(time()), 0, 23);
			$user->setSalt($salt);
			$plainPassword = $user->getPassword();

			// find the default encoder
			$encoder = $app['security.encoder.digest'];
			// compute the encoded password
			$password = $encoder->encodePassword($plainPassword, $user->getSalt());
			$user->setPassword($password);

			$this->repository['userRepository']->save($user);
			$app['session']->getFlashBag()->add('success', 'The user was successfully created.');
			return $app->redirect($app["url_generator"]->generate('listUser'));
		}
		return $app['twig']->render('Pages/User/Add.html.twig', array(
				'title' => 'New user',
				'userForm' => $userForm->createView())
		);
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, Application $app, $id) {

		$user = $this->repository['userRepository']->findOneById($id);
		$userForm = $app['form.factory']->create(new UserForm(), $user);
		$userForm->handleRequest($request);
		if ($userForm->isValid()) {
			$salt = substr(md5(time()), 0, 23);
			$user->setSalt($salt);
			$plainPassword = $user->getPassword();

			// find the default encoder
			$encoder = $app['security.encoder.digest'];
			// compute the encoded password
			$password = $encoder->encodePassword($plainPassword, $user->getSalt());
			$user->setPassword($password);

			$this->repository['userRepository']->save($user);
			$app['session']->getFlashBag()->add('success', 'The user was successfully created.');
			return $app->redirect($app["url_generator"]->generate('listUser'));
		}

		$userPasswordForm = $app['form.factory']->create(new UserPasswordForm(), $user);
		$userPasswordForm->handleRequest($request);
		if ($userPasswordForm->isValid()) {
			$salt = substr(md5(time()), 0, 23);
			$user->setSalt($salt);
			$plainPassword = $user->getPassword();

			// find the default encoder
			$encoder = $app['security.encoder.digest'];
			// compute the encoded password
			$password = $encoder->encodePassword($plainPassword, $user->getSalt());
			$user->setPassword($password);

			$this->repository['userRepository']->save($user);
			$app['session']->getFlashBag()->add('success', 'The user was successfully created.');
			return $app->redirect($app["url_generator"]->generate('listUser'));
		}

		return $app['twig']->render('Pages/User/Add.html.twig', array(
				'title' => 'Edit user',
				'userForm' => $userForm->createView(),
				'userPasswordForm' => $userForm->createView()
			)
		);
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
			$nbAdmin = $app['userRepository']->countByRole('ROLE_ADMIN');
			if($nbAdmin == 1) {
				$app['session']->getFlashBag()->add('error', 'Forbidden action: no more admin!');
				return $app->redirect('/admin/user/list');
			}
			$this->repository['userRepository']->delete($data['id']);
			$app['session']->getFlashBag()->add('success', 'The user was successfully removed.');
			return $app->redirect('/admin/user/list');
		}
	}

}