<?php

namespace chev\ChevalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('chevChevalBundle:Default:index.html.twig', array());
    }
}
