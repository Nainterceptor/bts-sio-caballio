<?php

namespace chev\BoxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PatureType extends AbstractType
{
	private $user;
    public function setUser($user) {
        $this->user = $user;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$user = $this->user;
        $builder
            ->add('libelle')
            ->add('taille', 'text', array(
			                                    'label' => "Nombre d'hectare",
												
										)
				)
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
        return 'pature';
    }
}
