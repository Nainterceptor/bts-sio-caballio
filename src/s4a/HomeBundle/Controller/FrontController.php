<?php

namespace s4a\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FrontController extends Controller
{
    
    public function indexAction()
    {
    	$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
        return $this->render('s4aHomeBundle:Front:indexAdmin.html.twig', array());
		
		elseif($this->get('security.context')->isGranted('ROLE_GERANT'))
		return $this->render('s4aHomeBundle:Front:indexGerant.html.twig', array());
		
		elseif($this->get('security.context')->isGranted('ROLE_USER'))
		return $this->render('s4aHomeBundle:Front:indexUser.html.twig', array());
		
		return $this->render('s4aHomeBundle:Front:index.html.twig', array());
    }
}
