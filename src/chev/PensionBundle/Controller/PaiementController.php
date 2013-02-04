<?php

namespace chev\PensionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\PensionBundle\Entity\Paiement;
use chev\PensionBundle\Form\PaiementType;

/**
 * Paiement controller.
 *
 */
class PaiementController extends Controller
{
    /**
     * Lists all Paiement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $this->getPaiements($em);

        return $this->render('chevPensionBundle:Paiement:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Paiement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getPaiement($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paiement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevPensionBundle:Paiement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Paiement entity.
     *
     */
    public function newAction()
    {
        $entity = new Paiement();
		$paiementType = new PaiementType();
		$paiementType->setUser($this->get('security.context')->getToken()->getUser());
        $form   = $this->createForm($paiementType, $entity);

        return $this->render('chevPensionBundle:Paiement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Paiement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Paiement();
        $paiementType = new PaiementType();
		$paiementType->setUser($this->get('security.context')->getToken()->getUser());
        $form = $this->createForm($paiementType, $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paiement_show', array('id' => $entity->getId())));
        }

        return $this->render('chevPensionBundle:Paiement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Paiement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getPaiement($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paiement entity.');
        }
		
		$paiementType = new PaiementType();
		$paiementType->setUser($this->get('security.context')->getToken()->getUser());
		
        $editForm   = $this->createForm($paiementType, $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevPensionBundle:Paiement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Paiement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getPaiement($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paiement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
		
		$paiementType = new PaiementType();
		$paiementType->setUser($this->get('security.context')->getToken()->getUser());
		
        $editForm = $this->createForm($paiementType, $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paiement_edit', array('id' => $id)));
        }

        return $this->render('chevPensionBundle:Paiement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Paiement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $this->getPaiement($em, $id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Paiement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paiement'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
	private function getPaiements(&$em) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevPensionBundle:Paiement')->findAll();
		return $em->getRepository('chevPensionBundle:Paiement')->findByGerant($user);
	}
	private function getPaiement(&$em, $id) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevPensionBundle:Paiement')->find($id);
		return $em->getRepository('chevPensionBundle:Paiement')->findOneByGerant($user, $id);
	}
}
