<?php

namespace s4a\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function indexAction()
    {
        return $this->render('s4aMenuBundle:Menu:index.html.twig', array());
    }
}
