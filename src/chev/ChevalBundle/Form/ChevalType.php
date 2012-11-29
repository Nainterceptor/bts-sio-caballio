<?php

namespace chev\ChevalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChevalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('date')
            ->add('race')
            ->add('proprietaire')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chev\ChevalBundle\Entity\Cheval'
        ));
    }

    public function getName()
    {
        return 'chev_chevalbundle_chevaltype';
    }
}
