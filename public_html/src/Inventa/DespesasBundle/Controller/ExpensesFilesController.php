<?php

namespace Inventa\DespesasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Inventa\DespesasBundle\Entity\ExpensesFiles;
use Inventa\DespesasBundle\Form\ExpensesFilesType;

/**
 * Expenses_Files controller.
 *
 */
class ExpensesFilesController extends Controller
{

    /**
     * Lists all Expenses_Files entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InventaDespesasBundle:Expenses')->findAll();

        return $this->render('InventaDespesasBundle:Expenses:index.html.twig', array(
            'entities' => $entities,
        

        ));
    }
    /**
     * Creates a new Expenses_Files entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ExpensesFiles();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('expenses_files_show', array('id' => $entity->getId())));
        }

        return $this->render('InventaDespesasBundle:Expenses_Files:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Expenses_Files entity.
    *
    * @param Expenses_Files $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ExpensesFiles $entity)
    {
        $form = $this->createForm(new ExpensesFilesType(), $entity, array(
            'action' => $this->generateUrl('expenses_files_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Inserir Imagem'));

        return $form;
    }

    /**
     * Displays a form to create a new Expenses_Files entity.
     *
     */
    public function newAction()
    {
        $entity = new ExpensesFiles();
        $form   = $this->createCreateForm($entity);

        return $this->render('InventaDespesasBundle:Expenses_Files:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Expenses_Files entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Expenses_Files')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Expenses_Files entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventaDespesasBundle:Expenses_Files:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Expenses_Files entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Expenses_Files')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Expenses_Files entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventaDespesasBundle:Expenses_Files:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Expenses_Files entity.
    *
    * @param Expenses_Files $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ExpensesFiles $entity)
    {
        $form = $this->createForm(new ExpensesFilesType(), $entity, array(
            'action' => $this->generateUrl('expenses_files_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Expenses_Files entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:ExpensesFiles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Expenses_Files entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('expenses_files_edit', array('id' => $id)));
        }

        return $this->render('InventaDespesasBundle:Expenses_Files:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Expenses_Files entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InventaDespesasBundle:Expenses_Files')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Expenses_Files entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('expenses_files'));
    }

    /**
     * Creates a form to delete a Expenses_Files entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('expenses_files_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}