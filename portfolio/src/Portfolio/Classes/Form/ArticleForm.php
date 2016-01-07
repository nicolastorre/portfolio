<?php

namespace Portfolio\Classes\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ArticleForm
 * @package Portfolio\Classes\Form
 */
class ArticleForm extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('title')
			->add('content', 'textarea')
			->add('publishedDate', 'date', array(
				'input'  => 'timestamp',
				'widget' => 'choice',
				'attr' => array(
					'class' => 'selectpicker'
				),
				'format' => 'dd MM yyyy',
				'pattern' => '{{ day }} {{ month }} {{ year }}',
				'years' => range(Date('Y'), 2005),
				'data' => \Date('U')
			))
			->add('image', 'file',array(
				'data_class' => null,
				'required' => false
			))
			->add('published', 'choice', array(
				'choices' => array(
					1   => 'Yes',
					0   => 'No',
				),
				'multiple' => false,
				'expanded' => true,
			))
			->add('author','hidden');
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'article';
	}
}