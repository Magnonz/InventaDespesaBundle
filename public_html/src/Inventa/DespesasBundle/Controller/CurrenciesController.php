<?php

namespace Inventa\DespesasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Inventa\DespesasBundle\Entity\Currencies;
use Inventa\DespesasBundle\Form\CurrenciesType;

/**
 * Currencies controller.
 *
 */
class CurrenciesController extends Controller {

    /**
     * Lists all Currencies entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InventaDespesasBundle:Currencies')->findAll();

        return $this->render('InventaDespesasBundle:Currencies:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Currencies entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Currencies();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('currencies_show', array('id' => $entity->getId())));
        }

        return $this->render('InventaDespesasBundle:Currencies:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Currencies entity.
     *
     * @param Currencies $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Currencies $entity) {
        $form = $this->createForm(new CurrenciesType(), $entity, array(
            'action' => $this->generateUrl('currencies_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Currencies entity.
     *
     */
    public function newAction() {
        $entity = new Currencies();
        $form = $this->createCreateForm($entity);

        return $this->render('InventaDespesasBundle:Currencies:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Currencies entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Currencies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currencies entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventaDespesasBundle:Currencies:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Currencies entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Currencies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currencies entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventaDespesasBundle:Currencies:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Currencies entity.
     *
     * @param Currencies $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Currencies $entity) {
        $form = $this->createForm(new CurrenciesType(), $entity, array(
            'action' => $this->generateUrl('currencies_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Currencies entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Currencies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currencies entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('currencies_edit', array('id' => $id)));
        }

        return $this->render('InventaDespesasBundle:Currencies:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Currencies entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InventaDespesasBundle:Currencies')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Currencies entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('currencies'));
    }

    /**
     * Creates a form to delete a Currencies entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('currencies_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array('class' => 'btn btn-primary')))
                        ->getForm()
        ;
    }

}
