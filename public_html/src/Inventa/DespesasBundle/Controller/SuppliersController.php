<?php

namespace Inventa\DespesasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Inventa\DespesasBundle\Entity\Suppliers;
use Inventa\DespesasBundle\Form\SuppliersType;

/**
 * Suppliers controller.
 *
 */
class SuppliersController extends Controller {

    /**
     * Lists all Suppliers entities.
     *
     */
    public function indexAction(Request $request) {
        
   
        
        $suppliers = new Suppliers();
        //-------------------------------Form Filtro----------------------------
        $filterform = $this->createFormBuilder($suppliers)
                ->add('status', 'choice', array('choices' => array(NULL => 'All', 'Active' => 'Active', 'Inactive' => 'Inactive'), 'required' => false, 'label' => 'Estado'))
                ->add('country_id', 'entity', array('class' => 'InventaDespesasBundle:Country', 'property' => 'name', 'label' => 'Paises', 'empty_value' => "All", 'required' => false))
                ->add('default_currency', 'entity', array('class' => 'InventaDespesasBundle:Currencies', 'property' => 'name', 'label' => 'Moeda', 'empty_value' => "All", 'required' => false))
                ->add('Search', 'submit', array('label' => 'Pesquisa'))
                ->getForm();


        $filterform->handleRequest($request);
        //----------------------------Filter Form se é valida-------------------
        if ($filterform->isValid()) {

            //----------------------------Filto Data---------------------------
            $fstatus = $filterform["status"]->getData();
            $fcountries = $filterform["country_id"]->getData();
            $fcurrency = $filterform["default_currency"]->getData();

            //----------------------------Filter form 'if'----------------------
            if ($fstatus != NULL || $fcountries != NULL || $fcurrency != NULL) {
                $em = $this->getDoctrine()->getManager();
                $qb = $em->getRepository('InventaDespesasBundle:Suppliers')->createQueryBuilder('s')
                        ->select('s');
                //-------------------------Inicio de Condições------------------
                if ($fstatus != NULL) {
                    $qb->andWhere('s.status = :fstatus');
                    $qb->setParameter('fstatus', $fstatus);
                }
                if ($fcountries != NULL) {
                    $qb->andWhere('s.country_id = :fcountries');
                    $qb->setParameter('fcountries', $fcountries);
                }
                if ($fcurrency != NULL) {
                    $qb->andWhere('s.default_currency = :fcurrency');
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

                $entities = $em->getRepository('InventaDespesasBundle:Suppliers')->findAll();
            }
        //-------------------Form Filter se nao for Valida----------------------
        } else {

            $em = $this->getDoctrine()->getManager();
            $exentities=$em->getRepository('InventaDespesasBundle:Expenses')->findAll();
            $entities = $em->getRepository('InventaDespesasBundle:Suppliers')->findAll();
        }



        return $this->render('InventaDespesasBundle:Suppliers:index.html.twig', array(
                    'entities' => $entities,
                    'exentities'=> $exentities,
                    'filterform' => $filterform->createView(),
        ));
        
        
        
    }

    /**
     * Creates a new Suppliers entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Suppliers();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('suppliers_show', array('id' => $entity->getId())));
        }

        return $this->render('InventaDespesasBundle:Suppliers:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Suppliers entity.
     *
     * @param Suppliers $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Suppliers $entity) {
        $form = $this->createForm(new SuppliersType(), $entity, array(
            'action' => $this->generateUrl('suppliers_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Suppliers entity.
     *
     */
    public function newAction() {
        $entity = new Suppliers();
        $form = $this->createCreateForm($entity);

        return $this->render('InventaDespesasBundle:Suppliers:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Suppliers entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Suppliers')->find($id);
        $tra =$em->getRepository('InventaDespesasBundle:Transactions')->findBy(array('supplier_id'=>$id));
        $tra_a=$em->getRepository('InventaDespesasBundle:TransactionApplied')->findBy(array('transaction_id'=>$tra));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Suppliers entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventaDespesasBundle:Suppliers:show.html.twig', array(
                    'entity' => $entity,
                    'tra_a'=> $tra_a,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Suppliers entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Suppliers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Suppliers entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventaDespesasBundle:Suppliers:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Suppliers entity.
     *
     * @param Suppliers $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Suppliers $entity) {
        $form = $this->createForm(new SuppliersType(), $entity, array(
            'action' => $this->generateUrl('suppliers_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Suppliers entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Suppliers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Suppliers entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('suppliers_edit', array('id' => $id)));
        }

        return $this->render('InventaDespesasBundle:Suppliers:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Suppliers entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InventaDespesasBundle:Suppliers')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Suppliers entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('suppliers'));
    }

    /**
     * Creates a form to delete a Suppliers entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('suppliers_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Apagar', 'attr' => array('class' => 'btn btn-primary')))
                        ->getForm()
        ;
    }

}
