<?php

namespace chev\PensionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', 'datetime', array(
		            'date_widget'		=> 'single_text',
		            'time_widget' 		=> 'single_text',
		            'input' 			=> 'datetime',
		            //'format' 			=> 'dd/MM/yyyy HH:mm',
		            'date_format' 		=> 'dd/MM/yyyy',
		            //'time_format' 	=> 'HH:mm',
		            'attr'	 			=> array('class' => 'datetimepicker')
            	)
            )
            ->add('dateFin', 'datetime', array(
		            'date_widget'		=> 'single_text',
		            'time_widget' 		=> 'single_text',
		            'input' 			=> 'datetime',
		            //'format' 			=> 'dd/MM/yyyy HH:mm',
		            'date_format' 		=> 'dd/MM/yyyy',
		            //'time_format' 	=> 'HH:mm',
		            'attr'	 			=> array('class' => 'datetimepicker')
            	)
            )
            ->add('dateFacture', 'datetime', array(
		            'date_widget'		=> 'single_text',
		            'time_widget' 		=> 'single_text',
		            'input' 			=> 'datetime',
		            //'format' 			=> 'dd/MM/yyyy HH:mm',
		            'date_format' 		=> 'dd/MM/yyyy',
		            //'time_format' 	=> 'HH:mm',
		            'attr'	 			=> array('class' => 'datetimepicker')
            	)
            )
            ->add('cheval')
            ->add('box')
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
        return 'chev_pensionbundle_facturetype';
    }
}
