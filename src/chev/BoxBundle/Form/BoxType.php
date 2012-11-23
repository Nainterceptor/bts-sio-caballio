<?php

namespace chev\BoxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BoxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'datetime', array(
                                                'date_widget' => 'single_text',
                                                'time_widget' => 'single_text',
                                                'input' => 'datetime',
                                                //'format' => 'dd/MM/yyyy HH:mm',
                                                'date_format' => 'dd/MM/yyyy',
                                                //'time_format' => 'HH:mm',
                                                'attr' => array('class' => 'datetimepicker')
                                        )
                )
            ->add('centre')
            ->add('type')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chev\BoxBundle\Entity\Box'
        ));
    }

    public function getName()
    {
        return 'chev_boxbundle_boxtype';
    }
}
