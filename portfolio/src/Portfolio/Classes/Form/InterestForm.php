<?php

namespace Portfolio\Classes\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class InterestForm
 * @package Portfolio\Classes\Form
 */
class InterestForm extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('label')
			->add('link')
			->add('bio','hidden');
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'interest';
	}
}