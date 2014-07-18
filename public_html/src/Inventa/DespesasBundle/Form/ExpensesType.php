<?php

namespace Inventa\DespesasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\HttpFoundation\File\File;

class ExpensesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         
            //------------------Company Id----------
            ->add('company_id', 'entity', array('class'=>'InventaDespesasBundle:Company' , 'property' => 'name' , 'label'=> 'Compania'))
            
            //------------------Supplier Id---------
            ->add('supplier_id', 'entity', array('class'=>'InventaDespesasBundle:Suppliers' , 'property' => 'name' , 'label' => 'Fornecedor'))

            //-----------------Date Billed----------------------------------------
            ->add('date_billed',  'date', array('input'  => 'datetime' , 'widget' => 'choice', 'label'=> 'Data Fatura'))
            
            //--------------------Currency------------------------------
            ->add('currency', 'entity', array('class'=>'InventaDespesasBundle:Currencies' , 'property' => 'name', 'label'=> 'Moeda'))

            //--------------------Countries------------------------------
            ->add('countries', 'entity', array('class'=>'InventaDespesasBundle:Country' , 'property' => 'name', 'label'=> 'Pais'))
            
            //--------------------Total---------------------------------
            ->add('total', 'number')
             
            //----------------------------Check-Billable-----------------
    
            ->add('billable' , 'checkbox', array('label'     => 'Billable' , 'required'  => false,))
            
            //----------------------------Check-Paid---------------------
    
            ->add('paid' , 'checkbox', array('label' => 'Paid' , 'required'  => false, 'label'=> 'Pago'))
            
            //----------------------------Categories Id------------------
    
            ->add('categories_id','entity', array('class'=>'InventaDespesasBundle:Categories' , 'property' => 'name' ,  'label' => 'Categorias'))

            //---------------------------------Date Due-------------------------
    
            ->add('date_due' ,'date', array('input'  => 'datetime' , 'widget' => 'choice' , 'label' => 'Date Due'))
            
            //---------------------------------Note Public----------------------
            
            ->add('note_public','textarea' , array('label' => 'Notas', 'required' => false))
                
           

                   
               
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inventa\DespesasBundle\Entity\Expenses'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'inventa_despesasbundle_expenses';
    }
}
