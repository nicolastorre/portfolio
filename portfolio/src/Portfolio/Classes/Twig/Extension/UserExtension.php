<?php
namespace Portfolio\Classes\Twig\Extension;

use Silex\Application;
use Twig\Extension;

/**
 * Class BreadCrumbExtension
 * @package nymo\Twig\Extension
 * @author Gregor Panek <gp@gregorpanek.de>
 */
class UserExtension extends \Twig_Extension
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
			'user' => new \Twig_Function_Method($this, 'renderUser', array('is_safe' => array('html')))
		);
	}

	/**
	 * Returns the rendered breadcrumb template
	 * @return string
	 */
	public function renderUser($id)
	{

		return $this->app['userRepository']->findOneById($id);

	}

	/**
	 * Returns the name of the extension.
	 *
	 * @return string The extension name
	 */
	public function getName()
	{
		return 'renderUser';
	}

}