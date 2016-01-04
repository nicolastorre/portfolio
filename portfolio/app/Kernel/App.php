<?php

// Register global error and exception handlers
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Gestion des erreurs
ErrorHandler::register();
ExceptionHandler::register();

$app = new Silex\Application();

// Langue
$app['locale'] = 'fr';

/* Mise en place des services SILEX */

// Session
$app->register(new Silex\Provider\SessionServiceProvider());

// Controller
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

// Doctrine
$app->register(new Silex\Provider\DoctrineServiceProvider());

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../../templates'));

// Service URL generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Formulaire
$app->register(new Silex\Provider\FormServiceProvider());

// Validation
$app->register(new Silex\Provider\ValidatorServiceProvider());

// Translation
$app->register(new Silex\Provider\TranslationServiceProvider());

// Security
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
	'security.firewalls' => array(
		'secured' => array(
			'pattern' => '^/admin',
			'anonymous' => false,
			'logout' => array('logout_path' => '/admin/logout', 'invalidate_session' => true),
			'form' => array('login_path' => '/login', 'check_path' => '/admin/login_check'),
			'users' => $app->share(function () use ($app) {
				return new Portfolio\Domain\Repository\UserRepository($app['db']);
			}),
		),
	),
));

/* Configuration */

require_once __DIR__ . '/../../app/Config/Dev.php';
// require_once __DIR__ . '/../../app/Config/Prod.php';

/* Ajout WebProfiler en mode DEBUG */
/*
if (isset($app['debug']) and $app['debug']) {
	$app->register(new Silex\Provider\WebProfilerServiceProvider(), array(
		'profiler.cache_dir' => __DIR__.'/../../cache/Profiler',
	));
}
*/
/* Mise en place des services CUSTOM */

// CUSTOM SERVICE REPOSITORY
$app['userRepository'] = function () use($app) {
	return new Portfolio\Domain\Repository\UserRepository($app['db']);
};

$app['articleRepository'] = $app->share(function () use($app) {
	return new Portfolio\Domain\Repository\ArticleRepository($app['db']);
});

$app['diplomaRepository'] = $app->share(function () use($app) {
	return new Portfolio\Domain\Repository\DiplomaRepository($app['db']);
});

$app['expRepository'] = $app->share(function () use($app) {
	return new Portfolio\Domain\Repository\ExpRepository($app['db']);
});

$app['skillRepository'] = $app->share(function () use($app) {
	return new Portfolio\Domain\Repository\SkillRepository($app['db']);
});

$app['interestRepository'] = $app->share(function () use($app) {
	return new Portfolio\Domain\Repository\InterestRepository($app['db']);
});

$app['bioRepository'] = $app->share(function () use($app) {
	return new Portfolio\Domain\Repository\BioRepository($app['db'], array(
		'diplomaRepository' => $app['diplomaRepository'],
		'expRepository' => $app['expRepository'],
		'skillRepository' => $app['skillRepository'],
		'interestRepository' => $app['interestRepository']
	));
});

$app['contactRepository'] = $app->share(function ($app) {
	return new Portfolio\Domain\Repository\ContactRepository($app['db']);
});

// CUSTOM SERVICE CONTROLLER
$app['articleController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\ArticleController(
		array(
			'articleRepository' => $app['articleRepository']
		));
});

$app['authenticationController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\AuthenticationController();
});

$app['bioController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\BioController(
		array(
			'bioRepository' => $app['bioRepository']
		));
});

$app['contactController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\ContactController(
		array(
			'contactRepository' => $app['contactRepository']
		));
});

$app['diplomaController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\DiplomaController(
		array(
			'diplomaRepository' => $app['diplomaRepository']
		));
});

$app['expController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\ExpController(
		array(
			'expRepository' => $app['expRepository']
		));
});

$app['interestController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\InterestController(
		array(
			'interestRepository' => $app['interestRepository']
		));
});

$app['skillController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\SkillController(
		array(
			'skillRepository' => $app['skillRepository']
		));
});

$app['userController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\UserController(
		array(
			'userRepository' => $app['userRepository']
		));
});

$app['staticController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\StaticController();
});

$app['paiementController'] = $app->share(function() use ($app) {
	return new Portfolio\Classes\Controller\PaiementController();
});

// Bootstrap the application
$app->boot();

/* Variables Glabal et Extensions TWIG */

$app['twig']->addGlobal('links', array(
	'email' => "#",
	'linkedin' => "#",
	'twitter' => "https://twitter.com/nicowez",
	'github' => "https://github.com/nicolastorre"
));

$app['twig']->addGlobal('recentArticles', $app['articleRepository']->findLast());

$app['twig'] = $app->share(
	$app->extend(
		'twig',
		function ($twig, $app) {
			$twig->addExtension(new \Portfolio\Classes\Twig\Extension\ImgDirExtension($app));
			return $twig;
		}
	)
);

$app['twig'] = $app->share(
	$app->extend(
		'twig',
		function ($twig, $app) {
			$twig->addExtension(new \Portfolio\Classes\Twig\Extension\UserExtension($app));
			return $twig;
		}
	)
);

$app['twig'] = $app->share(
	$app->extend(
		'twig',
		function ($twig, $app) {
			$twig->addExtension(new Twig_Extensions_Extension_Text());
			return $twig;
		}
	)
);

/* Gestion des erreurs */

if (isset($app['debug']) and !$app['debug']) {
	$app->error(function (\Exception $e, $code) use ($app) {
		switch ($code) {
			case 403:
				$message = 'Access denied.';
				break;
			case 404:
				$message = 'The requested resource could not be found.';
				break;
			default:
				$message = "Something went wrong.";
		}
		return $app['twig']->render('Pages/Error/Error.html.twig', array('message' => $message));
	});
}