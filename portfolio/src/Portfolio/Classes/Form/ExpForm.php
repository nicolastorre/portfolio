<?php

namespace Portfolio\Classes\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ExpForm
 * @package Portfolio\Classes\Form
 */
class ExpForm extends AbstractType
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
				'attr' => array(
					'class' => 'selectpicker'
				),
				'format' => 'dd MM yyyy',
				'pattern' => '{{ day }} {{ month }} {{ year }}',
				'years' => range(Date('Y'), 2005)
			))
			->add('endDate', 'date', array(
				'input'  => 'timestamp',
				'widget' => 'choice',
				'attr' => array(
					'class' => 'selectpicker'
				),
				'format' => 'dd MM yyyy',
				'pattern' => '{{ day }} {{ month }} {{ year }}',
				'years' => range(Date('Y'), 2005)
			))
			->add('title')
			->add('description','textarea')
			->add('current', 'choice', array(
				'choices' => array(
					1   => 'Yes',
					0   => 'No',
				),
				'multiple' => false,
				'expanded' => true,
			))
			->add('bio','hidden');
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'exp';
	}
}