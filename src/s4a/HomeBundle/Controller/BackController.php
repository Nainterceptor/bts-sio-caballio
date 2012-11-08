<?php

namespace s4a\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BackController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('s4aHomeBundle:Back:index.html.twig', array());
    }
}
