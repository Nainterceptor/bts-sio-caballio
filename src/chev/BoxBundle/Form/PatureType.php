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
            ->add('taille')
            ->add('centre')
            ->add('utilise')
            ->add('date')
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
