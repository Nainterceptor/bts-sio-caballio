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
            ->add('date', 'datetime', array(
                                                'date_widget' => 'single_text',
                                                'time_widget' => 'single_text',
                                                'input' => 'datetime',
                                                'date_format' => 'dd/MM/yyyy',
                                                'attr' => array('class' => 'datetimepicker')
                                        )
                )
            ->add('type', 'entity', array('label' => 'Type de box',
                                            'class' => 'chevBoxBundle:TypeBox',
                                            'query_builder' => function($er) use ($user) {
                                                if($user->hasRole('ROLE_ADMIN')) {
                                                    return $er->createQueryBuilder('t');
                                                }
                                                return $er->createQueryBuilder('t')
                                                ->join('t.centre', 'c')
                                                ->where('c.gerant = :gerant')
                                                ->setParameter(':gerant', $user);
                                            })
                 )
			->add('cheval')
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
