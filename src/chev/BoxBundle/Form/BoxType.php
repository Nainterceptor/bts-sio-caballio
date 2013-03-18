<?php

namespace chev\BoxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BoxType extends AbstractType
{
    private $user;
    public function setUser($user) {
        $this->user = $user;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->user;
        $builder
        	->add('numero')
        	->add('centre', 'entity', array('label' => 'Mon Centre',
                                            'class' => 'chevBoxBundle:Centre',
                                            'query_builder' => function($er) use ($user) {
                                                if($user->hasRole('ROLE_ADMIN')) {
                                                    return $er->createQueryBuilder('c');
                                                }
                                                return $er->createQueryBuilder('c')
                                                ->where('c.gerant = :gerant')
                                                ->setParameter(':gerant', $user);
                                            })
                 )
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
        return 'box';
    }
}
