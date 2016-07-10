<?php

namespace ScoutBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HouseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('title')
            ->add('metaTitle')
            ->add('metaDescription')
            ->add('description')
            ->add('address')
            ->add('price_terms')
            ->add('createdAt', 'datetime')
            ->add('updatedAt', 'datetime')
            ->add('region')
            ->add('numberOfRooms')
            ->add('enabled')
            ->add('landlord')
            ->add('location')
            ->add('slider')
            ->add('amenities')
            ->add('locations')
            ->add('translations')
            ->add('lang')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ScoutBundle\Entity\House'
        ));
    }
}
