<?php

namespace s4a\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuTopController extends Controller
{
    public function indexAction()
    {
        return $this->render('s4aMenuBundle:MenuTop:index.html.twig', array());
    }
}