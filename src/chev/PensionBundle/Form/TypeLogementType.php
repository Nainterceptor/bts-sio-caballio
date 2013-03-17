<?php

namespace chev\PensionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeLogementType extends AbstractType
{
	private $user;
	public function setUser($user) {
		$this->user = $user;
	}
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$user = $this->user;
        $builder
            ->add('libelle')
            ->add('prix')
            ->add('description')
            ->add('centre', 'entity', array(
					'class' 		=> 'chevBoxBundle:Centre',
					'query_builder' => function($er) use ($user) {
						if ($user->hasRole('ROLE_ADMIN')) {
							return $er->createQueryBuilder('centre');
						}
						return $er->createQueryBuilder('centre')
						->where('centre.gerant = :gerant')
						->setParameter(':gerant', $user);
					})
			)
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chev\PensionBundle\Entity\TypeLogement'
        ));
    }

    public function getName()
    {
        return 'typelogement';
    }
}
