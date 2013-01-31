<?php

namespace chev\BoxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('taille', 'text', array(
			                                    'label' => "Nombre d'hectare",
												
										)
				)
            ->add('centre')
            ->add('utilise', 'choice', array(
                                                'choices' => array(true => 'oui', false => 'non')
										)
                )
            ->add('date', 'datetime', array(
                                                'date_widget' => 'single_text',
                                                'time_widget' => 'single_text',
                                                'input' => 'datetime',
                                                'date_format' => 'dd/MM/yyyy',
                                                'attr' => array('class' => 'datetimepicker')
                                        )
                )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chev\BoxBundle\Entity\Pature'
        ));
    }

    public function getName()
    {
        return 'chev_boxbundle_paturetype';
    }
}
