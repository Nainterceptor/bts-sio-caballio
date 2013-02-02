<?php

namespace chev\ChevalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChevalType extends AbstractType
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
            ->add('nom')
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
            ->add('race', 'entity', array(
                                              'label' => 'Mes races',
                                              'class' => 'chevChevalBundle:Race',
                                              'query_builder' => function($er) use($user) {
                                                    if($user->hasRole('ROLE_ADMIN')) {
                                                        return $er->createQueryBuilder('r');
                                                    }
                                                    return $er->createQueryBuilder('r')
													->join('r.centre', 'c')
                                                    ->where('c.gerant = :gerant')
                                                    ->setParameter(':gerant', $user);
                                              }
                                      )
                 )
            ->add('proprietaire')
			->add('centre', 'entity', array(
                                              'label' => 'Mon centre',
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
            'data_class' => 'chev\ChevalBundle\Entity\Cheval'
        ));
    }

    public function getName()
    {
        return 'cheval';
    }
}
