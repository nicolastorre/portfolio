<?php

namespace Portfolio\Classes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Portfolio\Domain\Model\Contact;
use Portfolio\Classes\Form\ContactForm;
use Portfolio\Classes\Controller;

/**
 * Class ContactController
 * @package Portfolio\Classes\Controller
 */
class ContactController extends DefaultController
{
	/**
	 * @param Request $request
	 * @param Application $app
	 * @return mixed
	 */
	public function listAction(Request $request, Application $app) {
		$contacts = $this->repository['contactRepository']->findAll();

		return $app['twig']->render('Pages/Contact/List.html.twig', array(
			'contacts' => $contacts,
		));
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function addAction(Request $request, Application $app) {
		$contact = new contact();
		$contactForm = $app['form.factory']->create(new ContactForm(), $contact);
		$contactForm->handleRequest($request);
		if ($contactForm->isValid()) {
			$this->repository['contactRepository']->save($contact);
			// mail('contact@nicolas-torre.com', 'Feedback', $contact->getMessage());
			$app['session']->getFlashBag()->add('success', 'Votre message a été envoyé avec succès!');
			return $app->redirect('/contact/add');
		}
		return $app['twig']->render('Pages/Contact/Add.html.twig', array(
				'title' => 'Me contacter',
				'contactForm' => $contactForm->createView())
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
			$this->repository['contactRepository']->delete($data['id']);
			$app['session']->getFlashBag()->add('success', 'The contact was successfully removed.');
			return $app->redirect('/admin/contact/list');
		}
	}

}