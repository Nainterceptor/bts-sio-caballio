<?php

namespace chev\ChevalBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\ChevalBundle\Entity\Cheval;
use chev\ChevalBundle\Form\ChevalType;

/**
 * Cheval controller.
 *
 */
class ChevalController extends Controller
{
    /**
     * Lists all Cheval entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
		
		$entities = $this->getChevaux($em);

        return $this->render('chevChevalBundle:Cheval:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Cheval entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getCheval($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cheval entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevChevalBundle:Cheval:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Cheval entity.
     *
     */
    public function newAction()
    {
    	$em = $this->getDoctrine()->getManager();
		
        $entity = new Cheval();
        $chevalType = new ChevalType($em);
        $chevalType->setUser($this->get('security.context')->getToken()->getUser());
        $form   = $this->createForm($chevalType, $entity);

        return $this->render('chevChevalBundle:Cheval:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Cheval entity.
     *
     */
    public function createAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
		
        $entity  = new Cheval();
        $chevalType = new ChevalType($em);
        $chevalType->setUser($this->get('security.context')->getToken()->getUser());
        $form   = $this->createForm($chevalType, $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cheval_show', array('id' => $entity->getId())));
        }

        return $this->render('chevChevalBundle:Cheval:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cheval entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getCheval($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cheval entity.');
        }

        $chevalType = new ChevalType($em);
        $chevalType->setUser($this->get('security.context')->getToken()->getUser());
        $editForm   = $this->createForm($chevalType, $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevChevalBundle:Cheval:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Cheval entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getCheval($em, $id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cheval entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $chevalType = new ChevalType($em);
        $chevalType->setUser($this->get('security.context')->getToken()->getUser());
        $editForm   = $this->createForm($chevalType, $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cheval_edit', array('id' => $id)));
        }

        return $this->render('chevChevalBundle:Cheval:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Cheval entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $this->getCheval($em, $id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cheval entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cheval'));
    }
	
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

	/**
     * Récupérer la liste des chevaux suivant les règles de gestion
     * 
     * @param EntityManager $em
	 * 
     * @return Entity
     */
    private function getChevaux(&$em) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevChevalBundle:Cheval')->findAll();
		elseif($this->get('security.context')->isGranted('ROLE_GERANT'))
		    return $em->getRepository('chevChevalBundle:Cheval')->findByCentreGerant($user);
		
		return $em->getRepository('chevChevalBundle:Cheval')->findByProprietaire($user);
	}

    /**
     * Récupérer un cheval suivant les règles de gestion
     * 
     * @param EntityManager $em
     * @param int $id
     * 
     * @return Entity
     */
	private function getCheval(&$em, $id) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevChevalBundle:Cheval')->find($id);
		elseif($this->get('security.context')->isGranted('ROLE_GERANT'))
		    return $em->getRepository('chevChevalBundle:Cheval')->findOneByCentreGerant($user, $id);
		
		return $em->getRepository('chevChevalBundle:Cheval')->findOneByProprietaire($user);
	}
}
