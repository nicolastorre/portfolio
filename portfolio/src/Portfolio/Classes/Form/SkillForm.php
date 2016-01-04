<?php

namespace Portfolio\Classes\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class SkillForm
 * @package Portfolio\Classes\Form
 */
class SkillForm extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('label')
			->add('link')
			->add('level', 'number', array(
				'attr' => array(
					'min' => 0,
					'max' => 100
				)
			))
			->add('bio','hidden');
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'skill';
	}
}