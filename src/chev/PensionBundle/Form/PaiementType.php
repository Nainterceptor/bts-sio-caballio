<?php

namespace chev\PensionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaiementType extends AbstractType
{
	private $user;
	public function setUser($user) {
		$this->user = $user;
	}
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$user = $this->user;
        $builder
            ->add('montant')
            ->add('facture', 'entity', array( 	
            		'label' 		=> 'La facture',
					'class' 		=> 'chevPensionBundle:Facture',
					'query_builder' => function($er) use ($user) {
						if ($user->hasRole('ROLE_ADMIN')) {
							return $er->createQueryBuilder('facture');
						}
						return $er->createQueryBuilder('facture')
						->join('facture.typeLogement', 'tl')
						->join('tl.centre', 'c')
						->where('c.gerant = :gerant')
						->setParameter(':gerant', $user);
					})
			)
            ->add('typePaiement')
			->add('datePaiement', 'datetime', array(
		            'date_widget' 	=> 'single_text',
		            'time_widget' 	=> 'single_text',
		            'input' 		=> 'datetime',
		            //'format' 		=> 'dd/MM/yyyy HH:mm',
		            'date_format' 	=> 'dd/MM/yyyy',
		            //'time_format' => 'HH:mm',
		            'attr' 			=> array('class' => 'datetimepicker')
            		)
        	)
            ->add('dateEncaissement', 'datetime', array(
                    'date_widget' 	=> 'single_text',
                    'time_widget' 	=> 'single_text',
                    'input' 		=> 'datetime',
                    //'format' 		=> 'dd/MM/yyyy HH:mm',
                    'date_format' 	=> 'dd/MM/yyyy',
                    //'time_format' => 'HH:mm',
                    'attr' 			=> array('class' => 'datetimepicker')
                    )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chev\PensionBundle\Entity\Paiement'
        ));
    }

    public function getName()
    {
        return 'paiement';
    }
}
