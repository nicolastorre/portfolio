<?php

namespace Portfolio\Classes\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


/**
 * Class UserForm
 * @package Portfolio\Classes\Form
 */
class UserPasswordForm extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('password', 'repeated', array(
				'type'            => 'password',
				'invalid_message' => 'The password fields must match.',
				'options'         => array('required' => true),
				'first_options'   => array('label' => 'Password'),
				'second_options'  => array('label' => 'Repeat password'),
			));
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'userPassword';
	}
}