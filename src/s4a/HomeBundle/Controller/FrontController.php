<?php

namespace s4a\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FrontController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('s4aHomeBundle:Front:index.html.twig', array());
    }
}
