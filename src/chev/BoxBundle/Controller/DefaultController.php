<?php

namespace chev\BoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('chevBoxBundle:Default:index.html.twig', array());
    }
}
