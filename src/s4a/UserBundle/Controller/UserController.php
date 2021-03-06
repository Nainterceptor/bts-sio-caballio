<?php

namespace s4a\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use s4a\UserBundle\Form\UserType;
use s4a\UserBundle\Form\UserAdminType;
use s4a\UserBundle\Form\perpageType;


/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     */
    public function indexAction($page=1)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('s4aUserBundle:User');
        $user = $this->get('security.context')->getToken()->getUser();
		$request = $this->get('request');
		$session = $request->getSession();

		
		if(!$session->has('perPage')) {
			$session->set('perPage', 30);
		}
		$perPage = $session->get('perPage');
		
		$perPageForm = $this->createForm(new perpageType($perPage));
		if( $request->getMethod() == 'POST' ) {
			$perPageForm->bind($request);
				$perPage = $perPageForm->getData();
				$perPage = $perPage['perpage'];
				$session->set('perPage', $perPage);
		}
		
		
		$numPages = ceil($em->count()/$perPage);

        $entities = $em->userPagination($perPage, $page, $user);

        return $this->render('s4aUserBundle:User:index.html.twig', array(
            'entities' => $entities,
            'numberPages' => $numPages,
            'currentPage' => $page,
            'perPageForm'   => $perPageForm->createView()
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		$translator = $this->get('translator');
        $entity = $em->getRepository('s4aUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($translator->trans('user.errors.notfound', array('%id%' => $id), 'backoffice'));
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('s4aUserBundle:User:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
    	$userManager = $this->get('fos_user.user_manager');
		$entity = $userManager->createUser(); 
        $form   = $this->createForm($this->getFormBuilder(), $entity);

        return $this->render('s4aUserBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request)
    {
    	$userManager = $this->get('fos_user.user_manager');
		$entity = $userManager->createUser(); 
        $form = $this->createForm($this->getFormBuilder(), $entity);
        $form->bind($request);
        $password = $form->getData()->getPassword();
        $password = (!empty($password)) ? $password : $form->getData()->getUsername();
		$form->getData()->setPlainPassword($password);
		$form->getData()->setPassword(null);

        if ($form->isValid()) {
			$translator = $this->get('translator');
			$request = $this->get('request');
			$session = $request->getSession();
			
            $userManager->updateUser($entity);
			$session->getFlashBag()->add('success', $translator->trans('success.new', array(), 'backoffice'));
            return $this->redirect($this->generateUrl('s4admin_user_show', array('id' => $entity->getId())));
        }

        return $this->render('s4aUserBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
		$userManager = $this->get('fos_user.user_manager');
		$translator = $this->get('translator');
		$entity = $userManager->findUserBy(array('id' => $id));

        if (!$entity) {
            throw $this->createNotFoundException($translator->trans('user.errors.notfound', array('%id%' => $id), 'backoffice'));
        }

        $editForm = $this->createForm($this->getFormBuilder(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('s4aUserBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
		$userManager = $this->get('fos_user.user_manager');
		$translator = $this->get('translator');
		$entity = $userManager->findUserBy(array('id' => $id));

        if (!$entity) {
            throw $this->createNotFoundException($translator->trans('user.errors.notfound', array('%id%' => $id), 'backoffice'));
        }

        $deleteForm = $this->createDeleteForm($id);
		$password_old = $entity->getPassword();
        $editForm = $this->createForm($this->getFormBuilder(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
			$request = $this->get('request');
			$session = $request->getSession();
			
        	$password_new = $editForm->getData()->getPassword();
        	if(!empty($password_new) && $password_new != $password_old) {
				$editForm->getData()->setPlainPassword($editForm->getData()->getPassword());
				$editForm->getData()->setPassword(null);
				$session->getFlashBag()->add('success', $translator->trans('success.updatePassword', array(), 'backoffice'));
        	} else {
        		 $editForm->getData()->setPassword($password_old);
        	}

        	$userManager->updateUser($entity);
			$session->getFlashBag()->add('success', $translator->trans('success.update', array(), 'backoffice'));

            return $this->redirect($this->generateUrl('s4admin_user_edit', array('id' => $id)));
        }

        return $this->render('s4aUserBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    	$translator = $this->get('translator');
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
			$request = $this->get('request');
			$session = $request->getSession();
			$userManager = $this->get('fos_user.user_manager');
			$entity = $userManager->findUserBy(array('id' => $id));

            if (!$entity) {
                throw $this->createNotFoundException($translator->trans('user.errors.notfound', array('%id%' => $id), 'backoffice'));
            }
			$userManager->deleteUser($entity);
			$session->getFlashBag()->add('success', $translator->trans('success.delete', array(), 'backoffice'));
        }

        return $this->redirect($this->generateUrl('s4admin_user'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    private function getFormBuilder() {
        if($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return new UserAdminType;
        }
        return new UserType;
    }
}