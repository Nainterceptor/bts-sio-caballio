<?php

namespace chev\PensionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('chevPensionBundle:Default:index.html.twig', array());
    }
}
