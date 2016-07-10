<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use AppBundle\Entity\VillaCategory;
use AppBundle\Repository\VillaCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VillaCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('enabled')
            ->add('slug')
            ->add('metaTitle')
            ->add('metaDescription')
            ->add('description', TextareaType::class, array(
                'attr' => array(
                    'class' => 'tinymce',
                    'data-theme' => 'bbcode' // Skip it if you want to use default theme
                )
            ))
            ->add('lang', null, ['disabled' => true])
            ->add('translations',  EntityType::class, array(
                'class' => 'AppBundle:VillaCategory',
                'required' => false,
                'multiple' => true,
                'query_builder' => function(VillaCategoryRepository $repository) use ( $options ) {
                    $qb = $repository->createQueryBuilder("u");
                    return $qb
                        ->where($qb->expr()->neq('u.lang', $options["locale"]));


                }));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\VillaCategory',
            'locale' => 1,
        ));
    }
}
