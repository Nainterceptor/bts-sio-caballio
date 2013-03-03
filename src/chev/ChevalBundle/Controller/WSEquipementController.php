<?php

namespace chev\ChevalBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
	Symfony\Component\HttpFoundation\Response,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer,
    Symfony\Component\Serializer\Encoder\JsonEncoder,
    
    chev\ChevalBundle\Entity\Equipement,
    chev\ChevalBundle\Form\EquipementType;
	
/**
 * WebService Equipement controller.
 *
 */
class WSEquipementController extends Controller
{
	/*
	 * Liste tous les Equipements sous format Json
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('chevChevalBundle:Equipement')->findAll();
		
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
			'json'	=>	new JsonEncoder()));
		$json = $serializer->serialize($entities, 'json');
		
		return new Response($json);
	}
	
	/*
	 * Retourne l'Equipement par l'id sous format Json
	 */
	public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chevChevalBundle:Equipement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
		}
		
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
			'json'	=>	new JsonEncoder()));
		$json = $serializer->serialize($entity, 'json');
		
		return new Response($json);
    }
}
