<?php

namespace Inventa\DespesasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CurrenciesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('prefix')
            ->add('suffix')
            ->add('exchange_rate')
            ->add('company_id')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Inventa\DespesasBundle\Entity\Currencies'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'inventa_despesasbundle_currencies';
    }
}
