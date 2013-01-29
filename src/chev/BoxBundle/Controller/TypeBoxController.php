<?php

namespace chev\BoxBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\BoxBundle\Entity\TypeBox;
use chev\BoxBundle\Form\TypeBoxType;

/**
 * TypeBox controller.
 *
 */
class TypeBoxController extends Controller
{
    /**
     * Lists all TypeBox entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $this->getTypesBox($em);

        return $this->render('chevBoxBundle:TypeBox:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new TypeBox entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new TypeBox();
        $typeBoxType = new TypeBoxType();
        $typeBoxType->setUser($this->get('security.context')->getToken()->getUser());
        $form = $this->createForm($typeBoxType, $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('centre_typebox_show', array('id' => $entity->getId())));
        }

        return $this->render('chevBoxBundle:TypeBox:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new TypeBox entity.
     *
     */
    public function newAction()
    {
        $entity = new TypeBox();
        $typeBoxType = new TypeBoxType();
        $typeBoxType->setUser($this->get('security.context')->getToken()->getUser());
        $form   = $this->createForm($typeBoxType, $entity);

        return $this->render('chevBoxBundle:TypeBox:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TypeBox entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevBoxBundle:TypeBox')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeBox entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevBoxBundle:TypeBox:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing TypeBox entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevBoxBundle:TypeBox')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeBox entity.');
        }
        $typeBoxType = new TypeBoxType();
        $typeBoxType->setUser($this->get('security.context')->getToken()->getUser());
        
        $editForm = $this->createForm($typeBoxType, $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevBoxBundle:TypeBox:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TypeBox entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chevBoxBundle:TypeBox')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeBox entity.');
        }
        $typeBoxType = new TypeBoxType();
        $typeBoxType->setUser($this->get('security.context')->getToken()->getUser());
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm($typeBoxType, $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('centre_typebox_edit', array('id' => $id)));
        }

        return $this->render('chevBoxBundle:TypeBox:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TypeBox entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chevBoxBundle:TypeBox')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeBox entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('centre_typebox'));
    }

    /**
     * Creates a form to delete a TypeBox entity by id.
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
    
    /**
     * Récupérer la liste des centres suivant les règles de gestion
     * 
     * @param EntityManager $em
     * @return Entity
     */
    private function getTypesBox(&$em) {
        $user = $this->get('security.context')->getToken()->getUser();
        
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
            return $em->getRepository('chevBoxBundle:TypeBox')->findAll();
        
        return $em->getRepository('chevBoxBundle:TypeBox')->findByCentreGerant($user);
    } 
    /**
     * Récupérer un centre suivant les règles de gestion
     * 
     * @param EntityManager $em
     * @param int $id l'id du type de box
     * 
     * @return Entity
     */
    private function getTypeBox(&$em, $id) {
        $user = $this->get('security.context')->getToken()->getUser();
        
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
            return $em->getRepository('chevBoxBundle:TypeBox')->find($id);
        return $em->getRepository('chevBoxBundle:TypeBox')->findOneByCentreGerant($user, $id);

    }
}
