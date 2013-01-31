<?php

namespace chev\BoxBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\BoxBundle\Entity\Pature;
use chev\BoxBundle\Form\PatureType;

/**
 * Pature controller.
 *
 */
class PatureController extends Controller
{
    /**
     * Lists all Pature entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chevBoxBundle:Pature')->findAll();

        return $this->render('chevBoxBundle:Pature:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Pature entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevBoxBundle:Pature')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pature entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevBoxBundle:Pature:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Pature entity.
     *
     */
    public function newAction()
    {
        $entity = new Pature();
        $form   = $this->createForm(new PatureType(), $entity);

        return $this->render('chevBoxBundle:Pature:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Pature entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Pature();
        $form = $this->createForm(new PatureType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pature_show', array('id' => $entity->getId())));
        }

        return $this->render('chevBoxBundle:Pature:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pature entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevBoxBundle:Pature')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pature entity.');
        }

        $editForm = $this->createForm(new PatureType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevBoxBundle:Pature:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Pature entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevBoxBundle:Pature')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pature entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PatureType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pature_edit', array('id' => $id)));
        }

        return $this->render('chevBoxBundle:Pature:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pature entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chevBoxBundle:Pature')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pature entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pature'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
