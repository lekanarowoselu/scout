<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VillaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('metaTitle')
            ->add('metaDescription')
            ->add('price_terms')
            ->add('region')
            ->add('numberOfRooms')
            ->add('enabled')
            ->add('description')
//            ->add('createdAt', 'datetime')
//            ->add('updatedAt', 'datetime')
            ->add('sorting')
            ->add('categories')
            ->add('slider')
            ->add('services')
            ->add('amenities')
            ->add('surface_areas')
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
            'data_class' => 'AppBundle\Entity\Villa'
        ));
    }
}
