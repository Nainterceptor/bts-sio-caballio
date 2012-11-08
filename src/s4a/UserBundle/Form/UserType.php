<?php

namespace s4a\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            //->add('usernameCanonical')
            ->add('email')
            //->add('emailCanonical')
            //->add('enabled')
            //->add('salt')
            ->add('password', 'password', array('required'=>false))
            //->add('lastLogin')
            //->add('locked')
            //->add('expired')
            //->add('expiresAt')
            //->add('confirmationToken')
            //->add('passwordRequestedAt')
            //->add('roles')
            //->add('credentialsExpired')
            //->add('credentialsExpireAt')
            ->add(	'sex', 
            	  	'choice', 
            	  	array(
    					'choices'   => array(0 => 'choice.sex.0', 1 => 'choice.sex.1')
						)
				 )
            ->add('firstname')
            ->add('lastname')
            ->add('adress')
            ->add('zipcode')
            ->add('city')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 's4a\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user_label';
    }
}
