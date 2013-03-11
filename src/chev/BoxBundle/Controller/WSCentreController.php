<?php

namespace chev\BoxBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
	Symfony\Component\HttpFoundation\Response,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer,
    Symfony\Component\Serializer\Encoder\JsonEncoder,
    
    chev\BoxBundle\Entity\Centre,
    chev\BoxBundle\Form\CentreType;
	
/**
 * WebService Centre controller.
 *
 */
class WSCentreController extends Controller
{
	/*
	 * Liste tous les centres sous format Json
	 */
	public function listAction()
	{
		$em = $this->getDoctrine()->getManager();
        $centres = $em->getRepository('chevBoxBundle:Centre')->WSCentres();
		
		$serializer = new Serializer(
		                              array(new GetSetMethodNormalizer()), 
		                              array('json'	=>	new JsonEncoder())
                                     );

		$json = $serializer->serialize($centres, 'json');

		return new Response($json);
	}
	
	/*
	 * Retourne le centre par l'id sous format Json
	 */
	public function infosAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('chevBoxBundle:Centre')->WSCentre($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
		}
		
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
			'json'	=>	new JsonEncoder()));
		$json = $serializer->serialize($entity, 'json');
		
		return new Response($json);
    }
}
