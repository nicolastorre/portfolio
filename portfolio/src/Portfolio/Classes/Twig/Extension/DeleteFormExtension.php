<?php
namespace Portfolio\Classes\Twig\Extension;

use Silex\Application;
use Twig\Extension;

/**
 * Class BreadCrumbExtension
 * @package nymo\Twig\Extension
 * @author Gregor Panek <gp@gregorpanek.de>
 */
class DeleteFormExtension extends \Twig_Extension
{

	/**
	 * @var Application
	 */
	protected $app;

	/**
	 * @param \Silex\Application $app
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFunctions()
	{
		return array(
			'deleteform' => new \Twig_Function_Method($this, 'renderDeleteForm')
		);
	}

	/**
	 * Returns the rendered breadcrumb template
	 * @return string
	 */
	public function renderDeleteForm($route, $id)
	{

		$data = array(
			'id' => $id
		);
		return $this->app['form.factory']->createBuilder('form', $data)
			->setAction($this->app["url_generator"]->generate($route))
			->add('id', 'hidden')
//			->add('delete', 'submit')
			->getForm()
			->createView();
	}

	/**
	 * Returns the name of the extension.
	 *
	 * @return string The extension name
	 */
	public function getName()
	{
		return 'renderDeleteForm';
	}

}