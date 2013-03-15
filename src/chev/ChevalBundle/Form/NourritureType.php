<?php

namespace chev\ChevalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NourritureType extends AbstractType
{
	    private $user;
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$user = $this->user;
        $builder
            ->add('libelle')
			->add('centre', 'entity', array(
                                              'label' => 'Mes centres',
                                              'class' => 'chevBoxBundle:Centre',
                                              'query_builder' => function($er) use($user) {
                                                    if($user->hasRole('ROLE_ADMIN')) {
                                                        return $er->createQueryBuilder('c');
                                                    }
                                                    return $er->createQueryBuilder('c')
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
            'data_class' => 'chev\ChevalBundle\Entity\Nourriture'
        ));
    }

    public function getName()
    {
        return 'nourriture';
    }
}
