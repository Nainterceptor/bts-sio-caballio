<?php

namespace chev\PensionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SupplementType extends AbstractType
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
            ->add('prix')
            ->add('description')
            ->add('facture', 'entity', array(
					'class' 		=> 'chevPensionBundle:Facture',
					'query_builder' => function($er) use ($user) {
						if ($user->hasRole('ROLE_ADMIN')) {
							return $er->createQueryBuilder('facture');
						}
						return $er->createQueryBuilder('facture')
						->join('facture.typeLogement', 'tl')
						->join('tl.centre', 'c')
						->where('c.gerant = :gerant')
						->setParameter(':gerant', $user);
					})
			)
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chev\PensionBundle\Entity\Supplement'
        ));
    }

    public function getName()
    {
        return 'supplement';
    }
}
