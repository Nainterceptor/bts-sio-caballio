<?php

namespace chev\PensionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\PensionBundle\Entity\TypeLogement;
use chev\PensionBundle\Form\TypeLogementType;

/**
 * TypeLogement controller.
 *
 */
class TypeLogementController extends Controller
{
    /**
     * Lists all TypeLogement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $this->getTypeLogements($em);

        return $this->render('chevPensionBundle:TypeLogement:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a TypeLogement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getTypeLogement($id, $em);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeLogement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevPensionBundle:TypeLogement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new TypeLogement entity.
     *
     */
    public function newAction()
    {
        $entity = new TypeLogement();
        $typeLogementType = new TypeLogementType();
		$typeLogementType->setUser($this->get('security.context')->getToken()->getUser());
        $form = $this->createForm($typeLogementType, $entity);

        return $this->render('chevPensionBundle:TypeLogement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new TypeLogement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TypeLogement();
        $typeLogementType = new TypeLogementType();
		$typeLogementType->setUser($this->get('security.context')->getToken()->getUser());
        $form = $this->createForm($typeLogementType, $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typelogement_show', array('id' => $entity->getId())));
        }

        return $this->render('chevPensionBundle:TypeLogement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TypeLogement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getTypeLogement($id, $em);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeLogement entity.');
        }
		
		$typeLogementType = new TypeLogementType();
		$typeLogementType->setUser($this->get('security.context')->getToken()->getUser());
		
        $editForm = $this->createForm($typeLogementType, $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevPensionBundle:TypeLogement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TypeLogement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getTypeLogement($id, $em);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeLogement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
		
		$typeLogementType = new TypeLogementType();
		$typeLogementType->setUser($this->get('security.context')->getToken()->getUser());
		
        $editForm = $this->createForm($typeLogementType, $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typelogement_edit', array('id' => $id)));
        }

        return $this->render('chevPensionBundle:TypeLogement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TypeLogement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $this->getTypeLogement($id, $em);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeLogement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typelogement'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
	
	private function getTypeLogements(&$em) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevPensionBundle:TypeLogement')->findAll();
		return $em->getRepository('chevPensionBundle:TypeLogement')->findByGerant($user);
	}
	private function getTypeLogement($id, &$em) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevPensionBundle:TypeLogement')->find($id);
		return $em->getRepository('chevPensionBundle:TypeLogement')->findOneByGerant($user, $id);
	}
}
