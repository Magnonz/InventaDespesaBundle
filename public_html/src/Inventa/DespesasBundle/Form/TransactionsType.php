<?php

namespace Inventa\DespesasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransactionsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount')
            ->add('status','choice',array('choices'=>array('Active'=>'Active','Inactive'=>'Inactive')))
            ->add('supplier_id','entity',array('class'=>'InventaDespesasBundle:Suppliers' , 'property' => 'name','label'=>'Fornecedor'))
            ->add('currency')
            ->add('type','entity',array('class'=>'InventaDespesasBundle:TransactionType' , 'property' => 'name','label'=>'Tipo'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inventa\DespesasBundle\Entity\Transactions'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'inventa_despesasbundle_transactions';
    }
}
