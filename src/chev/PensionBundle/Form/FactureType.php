<?php

namespace chev\PensionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FactureType extends AbstractType
{
	private $user;
	public function setUser($user) {
		$this->user = $user;
	}
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$user = $this->user;
        $builder
            ->add('dateDebut', 'datetime', array(
		            'date_widget'		=> 'single_text',
		            'input' 			=> 'datetime',
		            'format' 		=> 'dd/MM/yyyy',
		            'attr'	 			=> array('class' => 'datetimepicker')
            	)
            )
            ->add('dateFin', 'datetime', array(
		            'date_widget'		=> 'single_text',
		            'input' 			=> 'datetime',
		            'format' 		=> 'dd/MM/yyyy',
		            'attr'	 			=> array('class' => 'datetimepicker')
            	)
            )
            ->add('box', 'entity', array( 'label' => 'Le Box',
											 'class' => 'chevBoxBundle:Box',
											 'query_builder' => function($er) use ($user) {
												if ($user->hasRole('ROLE_ADMIN')) {
													return $er->createQueryBuilder('b');
												}
												return $er->createQueryBuilder('b')
												->join('b.type', 't')
												->join('t.centre', 'c')
												->where('c.gerant = :gerant')
												->setParameter(':gerant', $user);
											 }
											)
			)
            ->add('utilisateur')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chev\PensionBundle\Entity\Facture'
        ));
    }

    public function getName()
    {
        return 'facture';
    }
}
