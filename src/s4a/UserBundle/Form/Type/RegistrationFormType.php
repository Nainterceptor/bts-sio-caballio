<?php

namespace s4a\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder
        	//->add('prenom')
			//->add('nom')
			//->add('sexe', 'choice', array('choices' => array('Femme','Homme')))
			//->add('age', 'birthday')
		;
    }

    public function getName()
    {
        return 's4a_user_registration';
    }
}