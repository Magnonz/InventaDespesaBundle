<?php

namespace Inventa\DespesasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//--------------------Form-----------------------
use Inventa\DespesasBundle\Form\ExpensesType;
//----------------------Models----------------------
use Inventa\DespesasBundle\Entity\Expenses;
use Inventa\DespesasBundle\Entity\Suppliers;

class ExpensesController extends Controller {

    //-----------------------------------------------------Index----------------------------------
    public function showallAction(Request $request) {

        $expenses_new = new Expenses();

       //-------------------------------Form Filtro----------------------------
        $filterform = $this->createFormBuilder($expenses_new)
                ->add('datestart', 'date', array('label' => 'Inicio', 'empty_value' => array('year' => 'Ano', 'month' => 'Mes', 'day' => 'Dia'), 'required' => false))
                ->add('dateend', 'date', array('label' => 'Fim', 'empty_value' => array('year' => 'Ano', 'month' => 'Mes', 'day' => 'Dia'), 'required' => false))
                ->add('supplier_id', 'entity', array('class' => 'InventaDespesasBundle:Suppliers', 'property' => 'name', 'label' => 'Fornecedores', 'empty_value' => "All", 'required' => false))
                ->add('status', 'choice', array('choices' => array(NULL => 'All', 'Active' => 'Active', 'Inactive' => 'Inactive'), 'required' => false,'label'=>'Estado'))
                //->add('autor' , 'entity' , array('class' => 'InventaDespesasBundle:Authors' , 'property' => 'name' , 'label' => ' Autores ' ))
                ->add('countries', 'entity', array('class' => 'InventaDespesasBundle:Country', 'property' => 'name', 'label' => 'Paises', 'empty_value' => "All", 'required' => false))
                ->add('categories_id', 'entity', array('class' => 'InventaDespesasBundle:Categories', 'property' => 'name', 'label' => 'Categorias', 'empty_value' => "All", 'required' => false))
                ->add('Search', 'submit', array('label' => 'Pesquisa'))
                ->getForm();

        $filterform->handleRequest($request);
        if ($filterform->isValid()) {

            //----------------------------Filto Data---------------------------

            $datestart = $filterform["datestart"]->getData();
            $dateend = $filterform["dateend"]->getData();
            $fsupplier = $filterform["supplier_id"]->getData();
            $fstatus = $filterform["status"]->getData();
            $fcountries = $filterform["countries"]->getData();
            $fcategories_id = $filterform["categories_id"]->getData();



            if ($datestart != NULL || $fsupplier != NULL || $fstatus != NULL || $fcountries != NULL || $fcategories_id != NULL) {
                //$rpt = $this->getDoctrine()->getRepository('InventaDespesasBundle:Expenses');
                $em = $this->getDoctrine()->getManager();
                $qb = $em->getRepository('InventaDespesasBundle:Expenses')->createQueryBuilder('e')
                        ->select('e');

                if ($datestart != NULL && $dateend != NULL) {
                    $qb->where('e.date_billed BETWEEN :datestart AND :dateend');
                    $qb->setParameter('datestart', $datestart->format('Y-m-d'));
                    $qb->setParameter('dateend', $dateend->format('Y-m-d'));
                } elseif ($datestart != NULL) {
                    $qb->where('e.date_billed > :datestart');
                    $qb->setParameter('datestart', $datestart->format('Y-m-d'));
                }
                if ($fsupplier != NULL) {
                    $qb->andWhere('e.supplier_id = :fsupplier');
                    $qb->setParameter('fsupplier', $fsupplier);
                }
                if ($fstatus != NULL) {
                    $qb->andWhere('e.status = :fstatus');
                    $qb->setParameter('fstatus', $fstatus);
                }
                if ($fcountries != NULL) {
                    $qb->andWhere('e.countries = :fcountries');
                    $qb->setParameter('fcountries', $fcountries);
                }
                if ($fcategories_id != NULL) {
                    $qb->andWhere('e.categories_id = :fcategories_id');
                    $qb->setParameter('fcategories_id', $fcategories_id);
                }

                $query = $qb->getQuery();
                try {
                    $entities = $query->getResult();
                } catch (QueryException $e) {

                    throw "Erro : " . $e;
                }
            } else { //Caso os filtros forem nulos
                $em = $this->getDoctrine()->getManager();

                $entities = $em->getRepository('InventaDespesasBundle:Expenses')->findAll();
            }
        }//Form Validation
        else {
            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('InventaDespesasBundle:Expenses')->findAll();

        }


        return $this->render('InventaDespesasBundle:Expenses:showall.html.twig', array(
                    'entities' => $entities,
                    'filterform' => $filterform->createView(),
        ));
    }

    //---------------------------------New Expenses-----------------------------
    public function newAction(Request $request) {

        
        $expenses_new = new Expenses();


        $form = $this->createFormBuilder($expenses_new)
                //-----------------------------Formulario---------------------------
                //-------------------------------Company Id-------------------------
                ->add('company_id', 'entity', array('class' => 'InventaDespesasBundle:Company', 'property' => 'name', 'label' => 'Empresa'))
                //-------------------------------Supplier Id------------------------
                ->add('supplier_id', 'entity', array('class' => 'InventaDespesasBundle:Suppliers', 'property' => 'name', 'label' => 'Fornecedor'))
                //-------------------------------Date Billed------------------------
                ->add('date_billed', 'date', array('input' => 'datetime', 'widget' => 'choice'))
                //--------------------------------Currency--------------------------
                ->add('currency', 'entity', array('class' => 'InventaDespesasBundle:Currencies', 'property' => 'name','label'=>'Moeda'))
                //--------------------------------Countries------------------------
                ->add('countries', 'entity', array('class' => 'InventaDespesasBundle:Country', 'property' => 'name','label'=>'Pais'))
                //---------------------------------Total----------------------------
                ->add('total', 'number', array('label' => 'Total'))
                //----------------------------Check-Billable------------------------
                ->add('billable', 'checkbox', array('label' => 'Billable', 'required' => false,))
                //----------------------------Check-Paid----------------------------
                ->add('paid', 'checkbox', array('label' => 'Paid', 'required' => false,))
                //----------------------------Categories Id------------------------- 	
                ->add('categories_id', 'entity', array('class' => 'InventaDespesasBundle:Categories', 'property' => 'name', 'label' => 'Categorias'))
                //---------------------------------Date Due------------------------- 	
                ->add('date_due', 'date', array('input' => 'datetime', 'widget' => 'choice', 'label' => 'Date Due'))
                //---------------------------------Note Public----------------------            
                ->add('note_public', 'textarea', array('label' => 'Notes', 'required' => false,'label'=>'Nota'))
                //-----------------------------------File---------------------------
                ->add('file', 'file', array('label' => 'Upload', 'required' => false))
                //-------------------------------Butão Save-------------------------            
                ->add('save', 'submit', array('label' => 'Guardar'))
                //-------------------------------Butão Save e New-------------------            
                ->add('saveanew', 'submit', array('label' => 'Guardar e Novo'))
                //-------------------------------Butão Reset------------------------               
                ->add('Limpar', 'reset')
                ->getForm();


        $form->handleRequest($request);



        if ($form->isValid()) {

        
            
            

            if ($form->get('saveanew')->isClicked()) {
                $expenses_new->setStatusbyPaid();

                $expenses_new->upload();

                $em = $this->getDoctrine()->getManager();

                $em->persist($expenses_new);

                $em->flush();

                return $this->redirect($this->generateUrl('expenses_new'));
            }
            if ($form->get('save')->isClicked()) {
                $expenses_new->setStatusbyPaid();

                $expenses_new->upload();

                $em = $this->getDoctrine()->getManager();

                $em->persist($expenses_new);
                
                
                        
                $em->flush();
                
                
                

                return $this->redirect($this->generateUrl('expenses'));
            }
        }

        return $this->render('InventaDespesasBundle:Expenses:new.html.twig', array('form' => $form->createView(),
        ));
    }

    //----------------------------------Edit Action-----------------------------
    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Expenses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel efectuar o seu pedido.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventaDespesasBundle:Expenses:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    //-------------------------------Edit Form----------------------------------
    private function createEditForm(Expenses $entity) {
        $form = $this->createForm(new ExpensesType(), $entity, array(
            'action' => $this->generateUrl('expenses_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    //------------------------------Update Action-------------------------------
    public function updateAction(Request $request, $id) {





        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Expenses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não consegue encontrar a entidade.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


        if ($editForm->isValid()) {

            $entity->setStatusbyPaid();
            

            $em->flush();

            return $this->redirect($this->generateUrl('expenses_edit', array('id' => $id)));
        }

        return $this->render('InventaDespesasBundle:Expenses:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    //-------------------------------Delete Action------------------------------
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InventaDespesasBundle:Expenses')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Não consegue encontrar a entidade.');
            }
            $entity->removeFile();
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('expenses'));
    }

    //---------------------------------Delete Form------------------------------
    /**
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('expenses_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array('class' => 'btn btn-primary')))
                        ->getForm()
        ;
    }

    //-------------------------------Show Action--------------------------------
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventaDespesasBundle:Expenses')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar a ententidade de Despesas.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventaDespesasBundle:Expenses:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    //----------------------------Download Action-------------------------------

    public function downloadAction($file) {
        if ($file == NULL) {
            return;
        }
        $request = $this->get('request');
        $path = $this->get('kernel')->getRootDir() . "/../web/expenses/";
        $content = file_get_contents($path . $file);

        $response = new Response();


        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $file);

        $response->setContent($content);
        return $response;
    }

}
