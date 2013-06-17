<?php

namespace s4a\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Stats controller.
 *
 */
class StatsController extends Controller
{
    /**
     * Lists Stats on Users.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository('s4aUserBundle:Stats');
        $nbr = $em->count();
        $mostConnect = $em->mostConnect(5);

        return $this->render('s4aUserBundle:Stats:all.html.twig', array(
              'count' => $nbr,
              'mostConnect' => $mostConnect,
      //      'entities' => $entities,
        ));
    }
}