<?php

namespace chev\ChevalBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\ChevalBundle\Entity\Vaccin;
use chev\ChevalBundle\Form\VaccinType;

/**
 * Vaccin controller.
 *
 */
class VaccinController extends Controller
{
    /**
     * Lists all Vaccin entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chevChevalBundle:Vaccin')->findAll();

        return $this->render('chevChevalBundle:Vaccin:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Vaccin entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevChevalBundle:Vaccin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vaccin entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevChevalBundle:Vaccin:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Vaccin entity.
     *
     */
    public function newAction()
    {
        $entity = new Vaccin();
        $form   = $this->createForm(new VaccinType(), $entity);

        return $this->render('chevChevalBundle:Vaccin:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Vaccin entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Vaccin();
        $form = $this->createForm(new VaccinType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cheval_vaccin_show', array('id' => $entity->getId())));
        }

        return $this->render('chevChevalBundle:Vaccin:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Vaccin entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevChevalBundle:Vaccin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vaccin entity.');
        }

        $editForm = $this->createForm(new VaccinType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevChevalBundle:Vaccin:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Vaccin entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevChevalBundle:Vaccin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vaccin entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new VaccinType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cheval_vaccin_edit', array('id' => $id)));
        }

        return $this->render('chevChevalBundle:Vaccin:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Vaccin entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chevChevalBundle:Vaccin')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vaccin entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cheval_vaccin'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
