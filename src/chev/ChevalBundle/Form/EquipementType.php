<?php

namespace chev\ChevalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('dateAjout', 'datetime', array(
                                                'date_widget' => 'single_text',
                                                'time_widget' => 'single_text',
                                                'input' => 'datetime',
                                                //'format' => 'dd/MM/yyyy HH:mm',
                                                'date_format' => 'dd/MM/yyyy',
                                                //'time_format' => 'HH:mm',
                                                'attr' => array('class' => 'datetimepicker')
                                        )
                )
            ->add('proprietaire')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chev\ChevalBundle\Entity\Equipement'
        ));
    }

    public function getName()
    {
        return 'chev_chevalbundle_equipementtype';
    }
}
