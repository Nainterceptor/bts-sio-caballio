<?php

namespace s4a\WebServiceBundle\Controller;


use Symfony\Component\HttpFoundation\Request,
	Symfony\Component\HttpFoundation\Response,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer,
    Symfony\Component\Serializer\Encoder\JsonEncoder;

use s4a\WebServiceBundle\Entity\Token;

/**
 * Token controller.
 *
 */
class TokenController extends Controller
{
	public function generateToken($user, $password)
	{
		$em = $this->getDoctrine()->getManager();
		$dateTime = new \DateTime;
		
		$entity = new Token();
		$entity->setUser($user);
		$entity->setToken(md5($user->getUsername() + $password + $dateTime->format('Y-m-d H:i:s')));
		$entity->setDatetime($dateTime);
		
		$em->persist($entity);
		$em->flush();
		
		return $entity;
	}
	
    public function loginTokenAction($username, $password)
	{
		$em = $this->getDoctrine()->getManager();

		$userManager = $this->get('fos_user.user_manager');
		$user = $userManager->findUserBy(array('username' => $username));
			
		if (!$user) {
			$response = array(
				"login"	=> false,
				"token" => null);
				
			$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
				'json'	=>	new JsonEncoder()));
			$json = $serializer->serialize($response, 'json');
			
			return new Response($json);
		}
		
	    $encoder = $this->get('security.encoder_factory')->getEncoder($user);
	    $encodedPass = $encoder->encodePassword($password, $user->getSalt());
		
		if ($user->getPassword() === $encodedPass) {
			$entity = $em->getRepository('s4aWebServiceBundle:Token')->findOneByUser($user);
			if (!$entity) {
				$entity = $this->generateToken($user, $password);
				$response = array(
					"login"	=> true,
					"token" => $entity->getToken());
			}
			else {
				$dateTime = new \DateTime;
				$sessionToken = $entity->getDatetime()->diff($dateTime, true);
				if ($sessionToken->h < 6) {
					$response = array(
						"login"	=> true,
						"token" => $entity->getToken());
				}
				else {
					$em->remove($entity);
					$this->generateToken($user, $password);
					$entity = $em->getRepository('s4aWebServiceBundle:Token')->findOneByUser($user);
					$response = array(
						"login"	=> true,
						"token" => $entity->getToken());
				}
			}
		}
		else {
			$response = array(
				"login"	=> false,
				"token" => null);
		}
		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
			'json'	=>	new JsonEncoder()));
		$json = $serializer->serialize($response, 'json');
		
		return new Response($json);
	}
}
