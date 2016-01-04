<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthenticationController
 * @package Portfolio\Classes\Controller
 */
class AuthenticationController
{
	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function loginAction(Request $request, Application $app) {
		return $app['twig']->render('Pages/Authentication/Login.html.twig', array(
			'error'         => $app['security.last_error']($request),
			'last_username' => $app['session']->get('_security.last_username'),
		));
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function logoutAction(request $request, Application $app) {
			$app['session']->set('isAuthenticated', false);
			return $app['login.basic_login_response'];
	}

}