<?php

namespace Chooshop\ChooshopBundle\Form;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('priority')
            ->add('description');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'      => 'Chooshop\ChooshopBundle\DTO\ProductTransfer',
            'csrf_protection' => false
        ]);
    }

    public function getName()
    {
        return 'product_create';
    }
}
