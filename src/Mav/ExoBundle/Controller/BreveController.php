<?php

namespace Mav\ExoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mav\ExoBundle\Entity\Breve;
use Mav\ExoBundle\Form\BreveType;

/**
 * Breve controller.
 *
 * @Route("/admin/breve")
 */
class BreveController extends Controller
{
    /**
     * Lists all Breve entities.
     *
     * @Route("/", name="admin_breve")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('MavExoBundle:Breve')->QueryAllArticle();
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return array(
            'pagination' => $pagination,
        );
    }

    /**
     * Creates a new Breve entity.
     *
     * @Route("/", name="admin_breve_create")
     * @Method("POST")
     * @Template("MavExoBundle:Breve:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Breve();
        $form = $this->createForm(new BreveType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_breve_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Breve entity.
     *
     * @Route("/new", name="admin_breve_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Breve();
        $form   = $this->createForm(new BreveType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Breve entity.
     *
     * @Route("/{id}", name="admin_breve_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MavExoBundle:Breve')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Breve entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Breve entity.
     *
     * @Route("/{id}/edit", name="admin_breve_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MavExoBundle:Breve')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Breve entity.');
        }

        $editForm = $this->createForm(new BreveType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Breve entity.
     *
     * @Route("/{id}", name="admin_breve_update")
     * @Method("PUT")
     * @Template("MavExoBundle:Breve:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MavExoBundle:Breve')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Breve entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BreveType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_breve_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Breve entity.
     *
     * @Route("/{id}", name="admin_breve_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MavExoBundle:Breve')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Breve entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_breve'));
    }

    /**
     * Creates a form to delete a Breve entity by id.
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
}
