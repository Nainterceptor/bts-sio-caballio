<?php

namespace chev\ChevalBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\ChevalBundle\Entity\Equipement;
use chev\ChevalBundle\Form\EquipementType;

/**
 * Equipement controller.
 *
 */
class EquipementController extends Controller
{
    /**
     * Lists all Equipement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $this->getEquipements($em);

        return $this->render('chevChevalBundle:Equipement:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Equipement entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getEquipement($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevChevalBundle:Equipement:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Equipement entity.
     *
     */
    public function newAction()
    {
        $entity = new Equipement();
        $EquipementType = new EquipementType();
        $EquipementType->setUser($this->get('security.context')->getToken()->getUser());
        $form   = $this->createForm($EquipementType, $entity);

        return $this->render('chevChevalBundle:Equipement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Equipement entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Equipement();
        $EquipementType = new EquipementType();
        $EquipementType->setUser($this->get('security.context')->getToken()->getUser());
        $form = $this->createForm($EquipementType, $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('equipement_show', array('id' => $entity->getId())));
        }

        return $this->render('chevChevalBundle:Equipement:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Equipement entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getEquipement($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipement entity.');
        }
        
        $EquipementType = new EquipementType();
        $EquipementType->setUser($this->get('security.context')->getToken()->getUser());
        $editForm = $this->createForm($EquipementType, $entity);
        
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevChevalBundle:Equipement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Equipement entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getEquipement($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        
        $EquipementType = new EquipementType();
        $EquipementType->setUser($this->get('security.context')->getToken()->getUser());
        $editForm = $this->createForm($EquipementType, $entity);
        
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('equipement_edit', array('id' => $id)));
        }

        return $this->render('chevChevalBundle:Equipement:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Equipement entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $this->getEquipement($em, $id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Equipement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('equipement'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
	
    /**
     * Récupérer la liste des équipements suivant les règles de gestion
     * 
     * @param EntityManager $em
	 * 
     * @return Entity
     */
    private function getEquipements(&$em) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevChevalBundle:Equipement')->findAll();
		elseif($this->get('security.context')->isGranted('ROLE_GERANT'))
		    return $em->getRepository('chevChevalBundle:Equipement')->findByCentreGerant($user);
		
		return $em->getRepository('chevChevalBundle:Equipement')->findByProprietaire($user);
	}

    /**
     * Récupérer un équipement suivant les règles de gestion
     * 
     * @param EntityManager $em
     * @param int $id
     * 
     * @return Entity
     */
	private function getEquipement(&$em, $id) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_GERANT'))
		    return $em->getRepository('chevChevalBundle:Equipement')->find($id);
		elseif($this->get('security.context')->isGranted('ROLE_GERANT'))
		    return $em->getRepository('chevChevalBundle:Equipement')->findOneByCentreGerant($user, $id);
		
		return $em->getRepository('chevChevalBundle:Equipement')->findOneByProprietaire($user);
	}
}
