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
												'date_widget' => 'single_text',
												'time_widget' => 'single_text',
                                                'input' => 'datetime',
                                                'date_format' => 'dd/MM/yyyy',
                                            	'attr' => array('class' => 'datetimepicker')
            	)
            )
            ->add('dateFin', 'datetime', array(
												'date_widget' => 'single_text',
												'time_widget' => 'single_text',
                                                'input' => 'datetime',
                                                'date_format' => 'dd/MM/yyyy',
                                            	'attr' => array('class' => 'datetimepicker')
            	)
            )
			->add('typeLogement', 'entity', array( 'label' => 'Type de logement',
											 'class' => 'chevPensionBundle:TypeLogement',
											 'query_builder' => function($er) use ($user) {
												if ($user->hasRole('ROLE_ADMIN')) {
													return $er->createQueryBuilder('tl');
												}
												return $er->createQueryBuilder('tl')
												->join('tl.centre', 'c')
												->where('c.gerant = :gerant')
												->setParameter(':gerant', $user);
											 }
											)
			)
            ->add('cheval', 'entity', array( 'label' => 'Cheval',
											 'class' => 'chevChevalBundle:Cheval',
											 'query_builder' => function($er) use ($user) {
												if ($user->hasRole('ROLE_ADMIN')) {
													return $er->createQueryBuilder('cheval');
												}
												return $er->createQueryBuilder('cheval')
												->join('cheval.centre', 'c')
												->where('c.gerant = :gerant')
												->setParameter(':gerant', $user);
											 }
											)
			)
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
