<?php

namespace Portfolio\Classes\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserForm
 * @package Portfolio\Classes\Form
 */
class UserForm extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('username')
			->add('password', 'repeated', array(
				'type'            => 'password',
				'invalid_message' => 'The password fields must match.',
				'options'         => array('required' => true),
				'first_options'   => array('label' => 'Password'),
				'second_options'  => array('label' => 'Repeat password'),
			))
			->add('role', 'choice', array(
				'choices' => array('ROLE_ADMIN' => 'Admin', 'ROLE_USER' => 'User'),
				'label' => 'Rights'
			));
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'user';
	}
}