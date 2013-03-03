<?php

namespace chev\ChevalBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
	Symfony\Component\HttpFoundation\Response,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer,
    Symfony\Component\Serializer\Encoder\JsonEncoder,
    
    chev\ChevalBundle\Entity\Cheval,
    chev\ChevalBundle\Form\ChevalType;
	
/**
 * WebService Cheval controller.
 *
 */
class WSChevalController extends Controller
{
	/*
	 * Liste tous les Chevaux sous format Json
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('chevChevalBundle:Cheval')->findAll();
		
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
			'json'	=>	new JsonEncoder()));
		$json = $serializer->serialize($entities, 'json');
		
		return new Response($json);
	}
	
	/*
	 * Retourne le Cheval par l'id sous format Json
	 */
	public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chevChevalBundle:Cheval')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
		}
		
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
			'json'	=>	new JsonEncoder()));
		$json = $serializer->serialize($entity, 'json');
		
		return new Response($json);
    }
}
