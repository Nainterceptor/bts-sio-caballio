<?php

namespace chev\PensionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\PensionBundle\Entity\TypePaiement;
use chev\PensionBundle\Form\TypePaiementType;

/**
 * TypePaiement controller.
 *
 */
class TypePaiementController extends Controller
{
    /**
     * Lists all TypePaiement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chevPensionBundle:TypePaiement')->findAll();

        return $this->render('chevPensionBundle:TypePaiement:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a TypePaiement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevPensionBundle:TypePaiement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypePaiement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevPensionBundle:TypePaiement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new TypePaiement entity.
     *
     */
    public function newAction()
    {
        $entity = new TypePaiement();
        $form   = $this->createForm(new TypePaiementType(), $entity);

        return $this->render('chevPensionBundle:TypePaiement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new TypePaiement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TypePaiement();
        $form = $this->createForm(new TypePaiementType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paiement_type_show', array('id' => $entity->getId())));
        }

        return $this->render('chevPensionBundle:TypePaiement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TypePaiement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevPensionBundle:TypePaiement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypePaiement entity.');
        }

        $editForm = $this->createForm(new TypePaiementType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevPensionBundle:TypePaiement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TypePaiement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevPensionBundle:TypePaiement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypePaiement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TypePaiementType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paiement_type_edit', array('id' => $id)));
        }

        return $this->render('chevPensionBundle:TypePaiement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TypePaiement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chevPensionBundle:TypePaiement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypePaiement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paiement_type'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
