<?php

namespace chev\PensionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chev\PensionBundle\Entity\Facture;
use chev\PensionBundle\Form\FactureType;

/**
 * Facture controller.
 *
 */
class FactureController extends Controller
{
    /**
     * Lists all Facture entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $this->getFactures($em);

        return $this->render('chevPensionBundle:Facture:index.html.twig', array(
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
		
        $entity = $this->getFactureAM($em, $id);
		
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevPensionBundle:Facture:show.html.twig', array(
            'entity'      => $entity['facture'],
            'montant'     => $entity['montant'],
            'delete_form' => $deleteForm->createView(),        ));
    }
	
	/**
     * Displays a form to create a new Cheval entity.
     *
     */
    public function newAction()
    {
        $entity = new Facture();
        $factureType = new FactureType();
		$factureType->setUser($this->get('security.context')->getToken()->getUser());
        $form = $this->createForm($factureType, $entity);

        return $this->render('chevPensionBundle:Facture:new.html.twig', array(
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
        $entity  = new Facture();
		$factureType = new FactureType();
		$factureType->setUser($this->get('security.context')->getToken()->getUser());
        $form = $this->createForm($factureType, $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facture_show', array('id' => $entity->getId())));
        }

        return $this->render('chevPensionBundle:Facture:new.html.twig', array(
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

        $entity = $this->getFacture($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facture entity.');
        }

        $factureType = new FactureType();
		$factureType->setUser($this->get('security.context')->getToken()->getUser());
        $editForm = $this->createForm($factureType, $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chevPensionBundle:Facture:edit.html.twig', array(
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

        $entity = $this->getFacture($em, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facture entity.');
        }

        $factureType = new FactureType();
		$factureType->setUser($this->get('security.context')->getToken()->getUser());
		
		$deleteForm = $this->createDeleteForm($id);
		
        $editForm = $this->createForm($factureType, $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facture_edit', array('id' => $id)));
        }

        return $this->render('chevPensionBundle:Facture:edit.html.twig', array(
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
            $entity = $this->getFacture($em, $id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Facture entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('facture'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
	
	/**
     * Récupérer la liste des factures suivant les règles de gestion
     * 
     * @param EntityManager $em
	 * 
     * @return Entity
     */
     private function getFactures(&$em) {
     	$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevPensionBundle:Facture')->findAll();
		elseif($this->get('security.context')->isGranted('ROLE_GERANT'))
		    return $em->getRepository('chevPensionBundle:Facture')->findByCentreGerant($user);
		
		return $em->getRepository('chevPensionBundle:Facture')->findByUtilisateur($user);
     }

	/**
     * Récupérer une facture suivant les règles de gestion
     * 
     * @param EntityManager $em
     * @param int $id
     * 
     * @return Entity
     */
	private function getFacture(&$em, $id) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevPensionBundle:Facture')->find($id);
		elseif($this->get('security.context')->isGranted('ROLE_GERANT'))
		    return $em->getRepository('chevPensionBundle:Facture')->findOneByCentreGerant($user, $id);
		
		return $em->getRepository('chevPensionBundle:Facture')->findOneByUtilisateur($user);
	}
	/**
     * Récupérer une facture avec montant suivant les règles de gestion
     * 
     * @param EntityManager $em
     * @param int $id
     * 
     * @return Entity
     */
	private function getFactureAM(&$em, $id) {
		$user = $this->get('security.context')->getToken()->getUser();
		
		if($this->get('security.context')->isGranted('ROLE_ADMIN'))
		    return $em->getRepository('chevPensionBundle:Facture')->findAM($id);
		elseif($this->get('security.context')->isGranted('ROLE_GERANT'))
		    return $em->getRepository('chevPensionBundle:Facture')->findOneByCentreGerantAM($user, $id);
		
		return $em->getRepository('chevPensionBundle:Facture')->findOneByUtilisateurAM($user, $id);
	}
}
