<?php

namespace chev\PensionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\PensionBundle\Entity\Supplement;
use chev\PensionBundle\Form\SupplementType;

/**
 * Supplement controller.
 *
 */
class SupplementController extends Controller
{
    /**
     * Lists all Supplement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $this->getSupplements($em);

        return $this->render('chevPensionBundle:Supplement:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Supplement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getSupplement($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Supplement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevPensionBundle:Supplement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Supplement entity.
     *
     */
    public function newAction()
    {
        $entity = new Supplement();
		$supplementType = new SupplementType();
		$supplementType->setUser($this->get('security.context')->getToken()->getUser());
        $form   = $this->createForm($supplementType, $entity);

        return $this->render('chevPensionBundle:Supplement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Supplement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Supplement();
        $supplementType = new SupplementType();
		$supplementType->setUser($this->get('security.context')->getToken()->getUser());
        $form = $this->createForm($supplementType, $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('supplement_show', array('id' => $entity->getId())));
        }

        return $this->render('chevPensionBundle:Supplement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Supplement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getSupplement($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Supplement entity.');
        }

        $supplementType = new SupplementType();
		$supplementType->setUser($this->get('security.context')->getToken()->getUser());
		
        $editForm   = $this->createForm($supplementType, $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevPensionBundle:Supplement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Supplement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getSupplement($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Supplement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $supplementType = new SupplementType();
		$supplementType->setUser($this->get('security.context')->getToken()->getUser());
		
        $editForm = $this->createForm($supplementType, $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('supplement_edit', array('id' => $id)));
        }

        return $this->render('chevPensionBundle:Supplement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Supplement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $this->getSupplement($em, $id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Supplement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('supplement'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
	
	private function getSupplements(&$em) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevPensionBundle:Supplement')->findAll();
		return $em->getRepository('chevPensionBundle:Supplement')->findByGerant($user);
	}
	private function getSupplement(&$em, $id) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevPensionBundle:Supplement')->find($id);
		return $em->getRepository('chevPensionBundle:Supplement')->findOneByGerant($user, $id);
	}
}
