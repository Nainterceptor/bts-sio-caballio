<?php

namespace chev\ChevalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChevalType extends AbstractType
{
	private $user;
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$user = $this->user;
        $builder
            ->add('nom')
			->add('sexe', 'choice', array(
		  		'choices' => array(
		  		'Mâle' => 'Mâle',
		  		'Femelle' => 'Femelle')
				)
			)
            ->add('nourriture', 'entity', array(
            	'label' => 'Aliment',
                'class' => 'chevChevalBundle:Nourriture',
                'query_builder' => function($er) use($user) {
                	if($user->hasRole('ROLE_ADMIN')) {
                		return $er->createQueryBuilder('r');
                	}
                    return $er->createQueryBuilder('r')
						->join('r.centre', 'c')
                        ->where('c.gerant = :gerant')
                        ->setParameter(':gerant', $user);
                	}
                 )
            )
			->add('quantite')
            ->add('proprietaire')
			->add('centre', 'entity', array(
				'label' => 'Mon centre',
				'class' => 'chevBoxBundle:Centre',
				'query_builder' => function($er) use($user) {
					if($user->hasRole('ROLE_ADMIN')) {
						return $er->createQueryBuilder('c');
					}
					return $er->createQueryBuilder('c')
						->where('c.gerant = :gerant')
						->setParameter(':gerant', $user);
					}
				)
            )
			->add('description','textarea', array(
				'required' => false
				)
			)
			->add('pature')
			->add('box')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chev\ChevalBundle\Entity\Cheval'
        ));
    }

    public function getName()
    {
        return 'cheval';
    }
}
