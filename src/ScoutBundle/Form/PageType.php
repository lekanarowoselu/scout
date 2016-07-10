<?php

namespace ScoutBundle\Form;

use ScoutBundle\Entity\PageCategory;
use ScoutBundle\Repository\PageCategoryRepository;
use ScoutBundle\Entity\Page;
use ScoutBundle\Repository\PageRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PageType extends AbstractType
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
            ->add('content', TextareaType::class, array(
                'attr' => array(
                    'class' => 'tinymce',
                    'data-theme' => 'bbcode' // Skip it if you want to use default theme
                )
            ))
            ->add('slug')
            ->add('subtitle')
            ->add('pageName')
            ->add('special')
            ->add('showInMenu')
            ->add('path')
            ->add('sorting')
//            ->add('createdAt', 'datetime')
//            ->add('updatedAt', 'datetime')
            ->add('slider')
            ->add('lang', null, array('disabled'=> true))

            //->add('pageCategory')
            ->add('pageCategory',  EntityType::class, array(
                'class' => 'ScoutBundle:PageCategory',
                  'query_builder' => function(PageCategoryRepository $repository) use ( $options ) {
                    $qb = $repository->createQueryBuilder("u");
                    return $qb
                        ->where('u.lang ='. $options["locale"]);


                }))

            ->add('translations',  EntityType::class, array(
                'class' => 'ScoutBundle:Page',
                'required' => false,
                'multiple' => true,
                'query_builder' => function(PageRepository $repository) use ( $options ) {
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
            'data_class' => 'ScoutBundle\Entity\Page',
            'locale' => 1
        ));
    }
}
