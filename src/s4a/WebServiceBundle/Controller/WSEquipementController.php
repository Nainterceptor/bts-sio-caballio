<?php

namespace s4a\WebServiceBundle\Controller;

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
	public function listAction($username, $token)
	{
		$em = $this->getDoctrine()->getManager();
		
		$userManager = $this->get('fos_user.user_manager');
		$user = $userManager->findUserBy(array('username' => $username));
		
		$serializer = new Serializer(
		                              array(new GetSetMethodNormalizer()), 
		                              	array('json'	=>	new JsonEncoder())
                                     );
		
		if ($em->getRepository('s4aWebServiceBundle:Token')->checkToken($user, $token) == true) {
			$entity = $em->getRepository('chevChevalBundle:Equipement')->WSEquipements($user);
			$json = $serializer->serialize($entity, 'json');
		}
		else {
			$json = $serializer->serialize(false, 'json');
		}
			
		return new Response($json);
	}
	
	/*
	 * Retourne l'Equipement par l'id sous format Json
	 */
	public function infosAction($username, $token, $id)
    {
        $em = $this->getDoctrine()->getManager();
		
		$userManager = $this->get('fos_user.user_manager');
		$user = $userManager->findUserBy(array('username' => $username));
		
		$serializer = new Serializer(
		                              array(new GetSetMethodNormalizer()), 
		                              	array('json'	=>	new JsonEncoder())
                                     );
		
		if ($em->getRepository('s4aWebServiceBundle:Token')->checkToken($user, $token) == true) {
			$entity = $em->getRepository('chevChevalBundle:Equipement')->WSEquipement($user, $id);
			$json = $serializer->serialize($entity, 'json');
		}
		else {
			$json = $serializer->serialize(false, 'json');
		}
      	
		return new Response($json);
    }
}
