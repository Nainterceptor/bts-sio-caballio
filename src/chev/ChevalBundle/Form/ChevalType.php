<?php

namespace chev\ChevalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;

class ChevalType extends AbstractType
{
	/**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
	
	/**
	 * @var user
	 */
	private $user;
	
	/**
	 * @var box
	 */
	private $box;
	
	/*
	 * Constructeur ChevalType
	 */
    public function __construct($em)
    {
        $this->em = $em;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
	public function setCheval($entity)
	{
		$this->cheval = $entity;
		return $this;
	}
	public function getBoxVide()
	{
		$em = $this->em->getRepository('chevBoxBundle:Box');
		
		if ($this->user->hasRole('ROLE_ADMIN')) {
			$entities = (array) $em->findAll();
		}
		else if ($this->user->hasRole('ROLE_GERANT')) {
			$entities = (array) $em->findByCentreGerant($this->user);
		}
		$i = 0;
		foreach ($entities as $box) {
			if ($box->getCheval() != null) {
				if ($box->getCheval() != $this->cheval) {
					unset($entities[$i]);
				}
			}
			$i++;
		}
		return $entities;
	}
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$user = $this->user;
        $builder
            ->add('nom')
			->add('sexe', 'choice', array(
		  		'choices' => array(
		  		'Mâle' => 'Mâle',
		  		'Femelle' => 'Femelle')
			))
            ->add('nourriture', 'entity', array(
            	'label' => 'Aliment',
                'class' => 'chevChevalBundle:Nourriture',
                'query_builder' => function($er) use($user) {
                	if($user->hasRole('ROLE_ADMIN')) {
                		return $er->createQueryBuilder('r');
                	}
                    return $er->createQueryBuilder('r')
						->join('r.centre', 'c')
                        ->where('c.gerant = :gerant')
                        ->setParameter(':gerant', $user);
                }
            ))
			->add('quantite')
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
			))
			->add('description','textarea', array(
				'required' => false
				)
			)
			->add('pature', 'entity', array(
				'label' => 'Pature',
				'class' => 'chevBoxBundle:Pature',
				'query_builder' => function($er) use($user) {
					if($user->hasRole('ROLE_ADMIN')) {
                		return $er->createQueryBuilder('p');
                	}
                    return $er->createQueryBuilder('p')
						->join('p.centre', 'c')
                        ->where('c.gerant = :gerant')
                        ->setParameter(':gerant', $user);
				},
				'required' => false,
			))
			->add('box', 'entity', array(
				'label' => 'Box',
				'class' => 'chevBoxBundle:Box',
				'choices' => $this->getBoxVide(),
				'required' => false,
			))
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
