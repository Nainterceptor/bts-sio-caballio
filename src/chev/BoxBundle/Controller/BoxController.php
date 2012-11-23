<?php

namespace chev\BoxBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\BoxBundle\Entity\Box;
use chev\BoxBundle\Form\BoxType;

/**
 * Box controller.
 *
 */
class BoxController extends Controller
{
    /**
     * Lists all Box entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chevBoxBundle:Box')->findAll();

        return $this->render('chevBoxBundle:Box:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Box entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Box();
        $form = $this->createForm(new BoxType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('centre_box_show', array('id' => $entity->getId())));
        }

        return $this->render('chevBoxBundle:Box:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Box entity.
     *
     */
    public function newAction()
    {
        $entity = new Box();
        $form   = $this->createForm(new BoxType(), $entity);

        return $this->render('chevBoxBundle:Box:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Box entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevBoxBundle:Box')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Box entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevBoxBundle:Box:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Box entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevBoxBundle:Box')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Box entity.');
        }

        $editForm = $this->createForm(new BoxType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevBoxBundle:Box:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Box entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevBoxBundle:Box')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Box entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BoxType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('centre_box_edit', array('id' => $id)));
        }

        return $this->render('chevBoxBundle:Box:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Box entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chevBoxBundle:Box')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Box entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('centre_box'));
    }

    /**
     * Creates a form to delete a Box entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
