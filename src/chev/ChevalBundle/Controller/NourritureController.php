<?php

namespace chev\ChevalBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\ChevalBundle\Entity\Nourriture;
use chev\ChevalBundle\Form\NourritureType;

/**
 * Nourriture controller.
 *
 */
class NourritureController extends Controller
{
    /**
     * Lists all Nourriture entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $this->getNourritures($em);

        return $this->render('chevChevalBundle:Nourriture:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Nourriture entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getNourriture($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nourriture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevChevalBundle:Nourriture:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Nourriture entity.
     *
     */
    public function newAction()
    {
        $entity = new Nourriture();
        $nourritureType = new NourritureType();
        $nourritureType->setUser($this->get('security.context')->getToken()->getUser());
        $form   = $this->createForm($nourritureType, $entity);

        return $this->render('chevChevalBundle:Nourriture:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Nourriture entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Nourriture();
        $nourritureType = new NourritureType();
        $nourritureType->setUser($this->get('security.context')->getToken()->getUser());
        $form   = $this->createForm($nourritureType, $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cheval_nourriture_show', array('id' => $entity->getId())));
        }

        return $this->render('chevChevalBundle:Nourriture:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Nourriture entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getNourriture($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nourriture entity.');
        }

        $nourritureType = new NourritureType();
        $nourritureType->setUser($this->get('security.context')->getToken()->getUser());
        $editForm   = $this->createForm($nourritureType, $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevChevalBundle:Nourriture:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Nourriture entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getNourriture($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nourriture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $nourritureType = new NourritureType();
        $nourritureType->setUser($this->get('security.context')->getToken()->getUser());
        $editForm   = $this->createForm($nourritureType, $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cheval_nourriture_show', array('id' => $id)));
        }

        return $this->render('chevChevalBundle:Nourriture:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Nourriture entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $nourritureType = new NourritureType();
        $nourritureType->setUser($this->get('security.context')->getToken()->getUser());
        $form   = $this->createForm($nourritureType, $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chevChevalBundle:Nourriture')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nourriture entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cheval_nourriture'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

	/**
     * Récupérer la liste des Nourritures suivant les règles de gestion
     * 
     * @param EntityManager $em
	 * 
     * @return Entity
     */
    private function getNourritures(&$em) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevChevalBundle:Nourriture')->findAll();
		
		return $em->getRepository('chevChevalBundle:Nourriture')->findByCentreGerant($user);
	}

    /**
     * Récupérer une Nourriture suivant les règles de gestion
     * 
     * @param EntityManager $em
     * @param int $id
     * 
     * @return Entity
     */
	private function getNourriture(&$em, $id) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevChevalBundle:Nourriture')->find($id);
		
		return $em->getRepository('chevChevalBundle:Nourriture')->findOneByCentreGerant($user, $id);
	}
}
