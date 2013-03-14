<?php

namespace s4a\WebServiceBundle\Controller;

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
	public function listAction($token)
	{
		$em = $this->getDoctrine()->getManager();
		
		$serializer = new Serializer(
		                              array(new GetSetMethodNormalizer()), 
		                              	array('json'	=>	new JsonEncoder())
                                     );
		
		if ($em->getRepository('s4aWebServiceBundle:Token')->checkToken($token) == true) {
			$user = $em->getRepository('s4aWebServiceBundle:Token')->findOneByToken($token)->getUser();
			$entity = $em->getRepository('chevChevalBundle:Cheval')->WSChevaux($user);
			$json = $serializer->serialize($entity, 'json');
		}
		else {
			$json = $serializer->serialize(false, 'json');
		}
			
		return new Response($json);
	}
	
	/*
	 * Retourne le Cheval par l'id sous format Json
	 */
	public function infosAction($token, $id)
    {
        $em = $this->getDoctrine()->getManager();
		
		$serializer = new Serializer(
		                              array(new GetSetMethodNormalizer()), 
		                              	array('json'	=>	new JsonEncoder())
                                     );
		
		if ($em->getRepository('s4aWebServiceBundle:Token')->checkToken($token) == true) {
			$user = $em->getRepository('s4aWebServiceBundle:Token')->findOneByToken($token)->getUser();
			$entity = $em->getRepository('chevChevalBundle:Cheval')->WSCheval($user, $id);
			$json = $serializer->serialize($entity, 'json');
		}
		else {
			$json = $serializer->serialize(false, 'json');
		}
      	
		return new Response($json);
    }
}
