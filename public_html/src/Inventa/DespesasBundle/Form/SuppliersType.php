<?php

namespace Inventa\DespesasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SuppliersType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text',array('label'=>'Nome'))
            ->add('email','text',array('label'=>'Email'))
            ->add('phone','number',array('label'=>'Telefone'))
            ->add('status','choice',array('choices'=>array('Active'=>'Active','Inactive'=>'Inactive')))
            ->add('notes','textarea',array('label'=>'Notas', 'required' => false))
            ->add('default_currency','entity',array('class'=>'InventaDespesasBundle:Currencies' , 'property' => 'name','label'=>'Moeda'))
            ->add('country_id','entity',array('class'=>'InventaDespesasBundle:Country' , 'property' => 'name','label'=>'Pais'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inventa\DespesasBundle\Entity\Suppliers'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'inventa_despesasbundle_suppliers';
    }
}
