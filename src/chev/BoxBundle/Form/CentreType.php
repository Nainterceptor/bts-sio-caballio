<?php

namespace chev\BoxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CentreType extends AbstractType
{
	private $user;
	
	public function setUser($user)
	{
		$this->user = $user;
	}
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$user = $this->user;
        $builder
            ->add('nom')
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
			->add('telephone')
            ->add('date', 'date', array(
				'widget' => 'single_text',
	            'input' => 'datetime',
	            'format' => 'dd/MM/yyyy',
	            'attr' => array('class' => 'datepicker')
            ))
            ->add('gerant', 'entity', array( 
            	'label' => 'Gerant',
            	'class' => 's4aUserBundle:User',
            	'query_builder' => function($er) use ($user) {
					if ($user->hasRole('ROLE_ADMIN')) {
						return $er->createQueryBuilder('user');
					}
					return $er->createQueryBuilder('user')
					->where('user = :gerant')
					->setParameter(':gerant', $user);
				 }
			))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chev\BoxBundle\Entity\Centre'
        ));
    }

    public function getName()
    {
        return 'centre';
    }
}
