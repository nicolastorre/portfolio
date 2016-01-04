<?php

namespace Portfolio\Classes\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class DiplomaForm
 * @package Portfolio\Classes\Form
 */
class DiplomaForm extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('startDate', 'date', array(
				'input'  => 'timestamp',
				'widget' => 'choice',
				'years' => range(2005,2020),
				'attr' => array(
					'class' => 'selectpicker'
				)
			))
			->add('endDate', 'date', array(
				'input'  => 'timestamp',
				'widget' => 'choice',
				'years' => range(2005,2020),
				'attr' => array(
					'class' => 'selectpicker'
				)
			))
			->add('title')
			->add('description','textarea')
			->add('bio','hidden');
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'diploma';
	}
}