<?php

namespace Inventa\DespesasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Inventa\DespesasBundle\Entity\Transactions;
use Inventa\DespesasBundle\Entity\TransactionApplied;
use Inventa\DespesasBundle\Form\TransactionsType;

/**
 * Transactions controller.
 *
 */
class TransactionsController extends Controller {

    public function indexAction(Request $request) {

        $transactions = new Transactions();
        //-------------------------------Form Filtro----------------------------
        $filterform = $this->createFormBuilder($transactions)
                ->add('status', 'choice', array('choices' => array(NULL => 'All', 'Active' => 'Active', 'Inactive' => 'Inactive'), 'required' => false, 'label' => 'Estado'))
                ->add('supplier_id', 'entity', array('class' => 'InventaDespesasBundle:Suppliers', 'property' => 'name', 'label' => 'Fornecedor', 'empty_value' => "All", 'required' => false))
                ->add('currency', 'entity', array('class' => 'InventaDespesasBundle:Currencies', 'property' => 'name', 'label' => 'Moeda', 'empty_value' => "All", 'required' => false))
                ->add('Search', 'submit', array('label' => 'Pesquisa'))
                ->getForm();


        $filterform->handleRequest($request);
        //----------------------------Filter Form se é valida-------------------
        if ($filterform->isValid()) {

            //----------------------------Filto Data---------------------------
            $fstatus = $filterform["status"]->getData();
            $fsuppliers = $filterform["supplier_id"]->getData();
            $fcurrency = $filterform["currency"]->getData();

            //----------------------------Filter form 'if'----------------------
            if ($fstatus != NULL || $fsuppliers != NULL || $fcurrency != NULL) {
                $em = $this->getDoctrine()->getManager();
                $qb = $em->getRepository('InventaDespesasBundle:Transactions')->createQueryBuilder('s')
                        ->select('s');
                //-------------------------Inicio de Condições------------------
                if ($fstatus != NULL) {
                    $qb->andWhere('s.status = :fstatus');
                    $qb->setParameter('fstatus', $fstatus);
                }
                if ($fsuppliers != NULL) {
                    $qb->andWhere('s.supplier_id = :fsupplier_id');
                    $qb->setParameter('fsupplier_id', $fsuppliers);
                }
                if ($fcurrency != NULL) {
                    $qb->andWhere('s.currency = :fcurrency');
                    $qb->setParameter('fcurrency', $fcurrency);
                }
                //----------------------Tentar ter Resultados-------------------




                $query = $qb->getQuery();

                try {

                    $entities = $query->getResult();
                } catch (QueryException $e) {

                    throw "Erro : " . $e;
                }
            } else { //Caso os filtros forem nulos
                $em = $this->getDoctrine()->getManager();

                $entities = $em->getRepository('InventaDespesasBundle:Transactions')->findAll();
            }
            //-------------------Form Filter se nao for Valida----------------------
        } else {

            $em = $this->getDoctrine()->getManager();
            $entities = $em->getRepository('InventaDespesasBundle:Transactions')->findAll();
        }


        return $this->render('InventaDespesasBundle:Transactions:index.html.twig', array(
                    'entities' => $entities,
                    'filterform' => $filterform->createView(),
        ));
    }

    /**
     * Creates a new Transactions entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Transactions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('transactions_show', array('id' => $entity->getId())));
        }

        return $this->render('InventaDespesasBundle:Transactions:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Transactions entity.
     *
     * @param Transactions $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Transactions $entity) {
        $form = $this->createForm(new TransactionsType(), $entity, array(
            'action' => $this->generateUrl('transactions_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Transactions entity.
     *
     */
    public function newAction() {
        $entity = new Transactions();
        $form = $this->createCreateForm($entity);



        return $this->render('InventaDespesasBundle:Transactions:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Transactions entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Transactions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transactions entity.');
        }


        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventaDespesasBundle:Transactions:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Transactions entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Transactions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transactions entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventaDespesasBundle:Transactions:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Transactions entity.
     *
     * @param Transactions $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Transactions $entity) {
        $form = $this->createForm(new TransactionsType(), $entity, array(
            'action' => $this->generateUrl('transactions_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Transactions entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Transactions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transactions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('transactions_edit', array('id' => $id)));
        }

        return $this->render('InventaDespesasBundle:Transactions:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Transactions entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InventaDespesasBundle:Transactions')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Transactions entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('transactions'));
    }

    /**
     * Creates a form to delete a Transactions entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('transactions_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array('class' => 'btn btn-primary')))
                        ->getForm()
        ;
    }

    public function transactions_expensesAction($id, $supplier_id, $currency) {
        $count = 0;

        $em = $this->getDoctrine()->getManager();

        $transaction = $em->getRepository('InventaDespesasBundle:Transactions')->find($id);

        $entities = $em->getRepository('InventaDespesasBundle:Expenses')->findBy(array('supplier' => $supplier_id, 'paid' => 'false', 'currency' => $currency));

        foreach ($entities as $loop) {

            $count++;
        }



        return $this->render('InventaDespesasBundle:Transactions:paying.html.twig', array(
                    'entities' => $entities,
                    'transaction' => $transaction,
        ));
    }

    public function transactions_paidAction($transaction_id, $expenses_id) {

        $tp = new TransactionApplied();
        $em = $this->getDoctrine()->getManager();
        $r_expenses = $em->getRepository('InventaDespesasBundle:Expenses')->find($expenses_id);
        $r_transactions = $em->getRepository('InventaDespesasBundle:Transactions')->find($transaction_id);

        $tp->applyTransaction($r_transactions, $r_expenses);
        $em->persist($tp);
        $em->flush();



        return $this->redirect($this->generateUrl('transactions'));
    }

}
