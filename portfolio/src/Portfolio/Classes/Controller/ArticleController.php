<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Gregwar\Image\Image;
use Portfolio\Domain\Model\Article;
use Portfolio\Classes\Form\ArticleForm;
use Portfolio\Classes\Controller;

/**
 * Class ArticleController
 * @package Portfolio\Classes\Controller
 */
class ArticleController extends DefaultController
{
	/**
	 * @param Request $request
	 * @param Form $articleForm
	 * @return mixed
	 * @throws \Exception
	 */
	private function upload(Request $request, Form $articleForm) {
		$files = $request->files->get($articleForm->getName());
		$path = __DIR__.self::UPLOAD_DIR;
		$filename = $files['image']->getClientOriginalName();
		$filepath = $path.$filename;
		$files['image']->move($path,$filename);
		chmod($filepath, 0755);

		Image::open($filepath)
			->zoomCrop(900, 300,"#346A85","center","center")
			->save($filepath);

		return $filename;
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function indexAction(Request $request, Application $app) {
		$articles = $this->repository['articleRepository']->findByPublished(self::ARTICLE_PUBLISHED);

		return $app['twig']->render('Pages/Article/Index.html.twig', array(
			'articles' => $articles
		));
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function listAction(Request $request, Application $app) {

		var_dump(realpath("index.php"));

		if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			$articles = $this->repository['articleRepository']->findAll();

			return $app['twig']->render('Pages/Article/List.html.twig', array(
				'articles' => $articles
			));
		}
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function addAction(Request $request, Application $app) {
		if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			$user = $app['security']->getToken()->getUser();
			$article = new Article();
			$article->setAuthor($user->getId());
			$articleForm = $app['form.factory']->create(new ArticleForm(), $article);
			$articleForm->handleRequest($request);
			if ($articleForm->isValid()) {
				$filename = $this->upload($request, $articleForm);
				$article->setImage($filename);

				$this->repository['articleRepository']->save($article);
				$app['session']->getFlashBag()->add('success', 'The article was successfully created.');
				return $app->redirect('/admin/article/list');
			}
			return $app['twig']->render('Pages/Article/Add.html.twig', array(
					'title' => 'New article',
					'articleForm' => $articleForm->createView())
			);
		}
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $id
	 * @return mixed
	 */
	public function showAction(Request $request, Application $app, $id) {
		$article = $this->repository['articleRepository']->findOneById($id);

		return $app['twig']->render('Pages/Article/Show.html.twig', array(
			'article' => $article
		));
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, Application $app, $id) {
		if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {
			$article = $this->repository['articleRepository']->findOneById($id);
			$articleForm = $app['form.factory']->create(new ArticleForm(), $article);
			$articleForm->handleRequest($request);
			if ($articleForm->isValid()) {
				if($article->getImage() !== NULL) {
					$filename = $this->upload($request, $articleForm);
					$article->setImage($filename);
				}

				$this->repository['articleRepository']->save($article);
				$app['session']->getFlashBag()->add('success', 'The article was successfully updated.');

				return $app->redirect('/admin/article/list');
			}
			return $app['twig']->render('Pages/Article/Add.html.twig', array(
					'title' => 'Edit article',
					'articleForm' => $articleForm->createView())
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
			$this->repository['articleRepository']->delete($id);
			$app['session']->getFlashBag()->add('success', 'The article was succesfully removed.');
			return $app->redirect('/admin/article/list');
		}
	}
}