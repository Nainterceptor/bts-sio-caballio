<?php

namespace s4a\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('s4aMenuBundle:Default:index.html.twig', array('name' => $name));
    }
}
