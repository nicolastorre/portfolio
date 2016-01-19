<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Portfolio\Classes\Controller;

/**
 * Class StaticController
 * @package Portfolio\Classes\Controller
 */
class StaticController extends DefaultController
{
	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function mentionslegalesAction(Request $request, Application $app) {

		return $app['twig']->render('Pages/Static/Mentionslegales.html.twig');
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function bikelocatorAction(Request $request, Application $app) {

		return $app['twig']->render('Pages/Static/Bikelocator.html.twig');
	}

}