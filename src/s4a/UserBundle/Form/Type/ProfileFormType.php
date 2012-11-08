<?php

namespace s4a\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options);

        // add your custom field
        $builder
        	//->add('prenom')
			//->add('nom')
			//->add('adresse')
			//->add('codepostal')
			//->add('ville')
			//->add('telephone')
			//->add('contactable')
			//->add('skype')
			//->add('sexe', 'choice', array('choices' => array('Femme','Homme')))
			//->add('age', 'birthday')
		;
    }

    public function getName()
    {
        return 'user_profile';
    }
}