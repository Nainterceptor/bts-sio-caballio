<?php

namespace s4a\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class perpageType extends AbstractType
{
	public $default_perpage;
	public function __construct($default) {
		//parent::__construct();
		$this->default_perpage = $default;
	}
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('perpage', 'integer', array('label' => 'perpage',
											  'data' => $this->default_perpage))
		;
    }

    public function getName()
    {
        return 'perPage';
    }
}
