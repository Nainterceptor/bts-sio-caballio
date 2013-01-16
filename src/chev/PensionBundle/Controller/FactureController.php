<?php

namespace chev\PensionBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\PensionBundle\Entity\Facture;

/**
 * Facture controller.
 *
 */
class FactureController extends Controller
{
    /**
     * Lists all Facture entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chevPensionBundle:Facture')->findAll();

        return $this->render('chevPensionBundle:Facture:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Facture entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevPensionBundle:Facture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facture entity.');
        }

        return $this->render('chevPensionBundle:Facture:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

}
