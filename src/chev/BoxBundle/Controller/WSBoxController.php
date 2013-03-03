<?php

namespace chev\BoxBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
	Symfony\Component\HttpFoundation\Response,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer,
    Symfony\Component\Serializer\Encoder\JsonEncoder,
    
    chev\BoxBundle\Entity\Box,
    chev\BoxBundle\Form\BoxType;
	
/**
 * WebService Box controller.
 *
 */
class WSBoxController extends Controller
{
	/*
	 * Liste tous les boxes sous format Json
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('chevBoxBundle:Box')->findAll();
		
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
			'json'	=>	new JsonEncoder()));
		$json = $serializer->serialize($entities, 'json');
		
		return new Response($json);
	}
	
	/*
	 * Retourne le box par l'id sous format Json
	 */
	public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chevBoxBundle:Box')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
		}
		
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
			'json'	=>	new JsonEncoder()));
		$json = $serializer->serialize($entity, 'json');
		
		return new Response($json);
    }
}
