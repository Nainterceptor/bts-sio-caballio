<?php

namespace chev\BoxBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
	Symfony\Component\HttpFoundation\Response,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer,
    Symfony\Component\Serializer\Encoder\JsonEncoder,
    
    chev\BoxBundle\Entity\Pature,
    chev\BoxBundle\Form\PatureType;
	
/**
 * WebService Centre controller.
 *
 */
class WSPatureController extends Controller
{
	/*
	 * Liste tout les Patures sous format Json
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('chevBoxBundle:Pature')->findAll();
		
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
			'json'	=>	new JsonEncoder()));
		$json = $serializer->serialize($entities, 'json');
		
		return new Response($json);
	}
	
	/*
	 * Retourne le Pature par l'id sous format Json
	 */
	public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chevBoxBundle:Pature')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
		}
		
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
			'json'	=>	new JsonEncoder()));
		$json = $serializer->serialize($entity, 'json');
		
		return new Response($json);
    }
}
