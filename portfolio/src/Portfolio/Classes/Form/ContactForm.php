<?php

namespace Portfolio\Classes\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ContactForm
 * @package Portfolio\Classes\Form
 */
class ContactForm extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('email','email',array('label' => 'E-mail'))
			->add('object','text',array('label' => 'Objet'))
			->add('message','textarea',array('label' => 'Message'));
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'contact';
	}
}