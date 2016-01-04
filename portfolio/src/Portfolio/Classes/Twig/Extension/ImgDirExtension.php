<?php
namespace Portfolio\Classes\Twig\Extension;

use Silex\Application;
use Twig\Extension;

/**
 * Class BreadCrumbExtension
 * @package nymo\Twig\Extension
 * @author Gregor Panek <gp@gregorpanek.de>
 */
class ImgDirExtension extends \Twig_Extension
{

	/**
	 * Directory Image
	 */
	CONST IMG_DIR = "upload/";

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
			'imgdir' => new \Twig_Function_Method($this, 'renderImgDir', array('is_safe' => array('html')))
		);
	}

	/**
	 * Returns the rendered breadcrumb template
	 * @return string
	 */
	public function renderImgDir($img)
	{

		return self::IMG_DIR.$img;

	}

	/**
	 * Returns the name of the extension.
	 *
	 * @return string The extension name
	 */
	public function getName()
	{
		return 'renderImgDir';
	}

}