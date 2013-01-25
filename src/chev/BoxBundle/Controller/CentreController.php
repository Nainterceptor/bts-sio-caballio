<?php

namespace chev\BoxBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    
    chev\BoxBundle\Entity\Centre,
    chev\BoxBundle\Form\CentreType;

/**
 * Centre controller.
 *
 */
class CentreController extends Controller
{
    /**
     * Lists all Centre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $this->getCentres($em);

        return $this->render('chevBoxBundle:Centre:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Centre entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Centre();
        $form = $this->createForm(new CentreType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('centre_show', array('id' => $entity->getId())));
        }

        return $this->render('chevBoxBundle:Centre:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Centre entity.
     *
     */
    public function newAction()
    {
        $entity = new Centre();
        $form   = $this->createForm(new CentreType(), $entity);

        return $this->render('chevBoxBundle:Centre:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Centre entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $this->getCentre($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevBoxBundle:Centre:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Centre entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $this->getCentre($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $editForm = $this->createForm(new CentreType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevBoxBundle:Centre:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Centre entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $this->getCentre($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Centre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CentreType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('centre_edit', array('id' => $id)));
        }

        return $this->render('chevBoxBundle:Centre:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Centre entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $entity = $this->getCentre($em, $id);;

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Centre entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('centre'));
    }

    /**
     * Creates a form to delete a Centre entity by id.
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
    private function getCentres(&$em) {
        $user = $this->get('security.context')->getToken()->getUser();
        
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
            return $em->getRepository('chevBoxBundle:Centre')->findAll();
        
        return $em->getRepository('chevBoxBundle:Centre')->findByGerant($user);
    } 
    /**
     * Récupérer un centre suivant les règles de gestion
     * 
     * @param EntityManager $em
     * @param int $id
     * 
     * @return Entity
     */
    private function getCentre(&$em, $id) {
        $user = $this->get('security.context')->getToken()->getUser();
        
        if($this->get('security.context')->isGranted('ROLE_ADMIN'))
            return $em->getRepository('chevBoxBundle:Centre')->find($id);
        
        return $em->getRepository('chevBoxBundle:Centre')->findBy(array('id' => $id, 'gerant' => $user));

    }
}
