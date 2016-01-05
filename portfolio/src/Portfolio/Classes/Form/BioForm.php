<?php

namespace Portfolio\Classes\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class BioForm
 * @package Portfolio\Classes\Form
 */
class BioForm extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('firstname')
			->add('lastname')
			->add('presentation','textarea')
			->add('image', 'file',array(
				'data_class' => null,
				'required' => false
			));
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'bio';
	}
}