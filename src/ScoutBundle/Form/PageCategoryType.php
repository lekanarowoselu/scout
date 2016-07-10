<?php

namespace ScoutBundle\Form;

use ScoutBundle\Entity\PageCategory;
use ScoutBundle\Repository\PageCategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use AppBundle\Form\EventListener\LanguageFieldInEditSubscriber;



class PageCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('title')
            ->add('slug')
            ->add('metaTitle')
            ->add('metaDescription')
//            ->add('createdAt', 'datetime')
//            ->add('updatedAt', 'datetime')
            ->add('sorting')
            ->add('showInMenu')
            ->add('special')
            ->add('lang', null, ['disabled' => true])

            ->add('parent',  EntityType::class, array(
                'class' => 'ScoutBundle:PageCategory',
                'required' => false,
                 'query_builder' => function(PageCategoryRepository $repository) use ( $options ) {
                    $qb = $repository->createQueryBuilder("u");
                    return $qb

            ->where('u.lang ='. $options["locale"]);
                     }))

            ->add('translations',  EntityType::class, array(
                'class' => 'ScoutBundle:PageCategory',
                'required' => false,
                'multiple' => true,
                'query_builder' => function(PageCategoryRepository $repository) use ( $options ) {
                    $qb = $repository->createQueryBuilder("u");
                          return $qb
                        ->where($qb->expr()->neq('u.lang', $options["locale"]));


                }));




//        $builder->add("profileType",
//            "entity",
//            array( "class" => "NamespaceWebsiteBundle:ProfileType",
//                "query_builder" => function(EntityRepository $er) use ( $options ){
//                    return $er->createQueryBuilder('s')
//                        ->orderBy("s.name_".$options["locale"], "ASC");
//                },
//                "property" => "name_".$options["locale"],
//                "error_bubbling" => true,
//                "label" => "label.account_type",
//                "translation_domain" => "profileform",
//                "invalid_message" => "userprofiletype.invalid",
//                "required" => false));


        //$builder->addEventSubscriber(new LanguageFieldInEditSubscriber());
    }
//$qb->orWhere($qb->expr()->like('c.title', "?$i"));
//$qb->orWhere($qb->expr()->like('c.content', "?$i"));
//$qb->setParameter($i, '%' . $term . '%');


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ScoutBundle\Entity\PageCategory',
            'locale' => 1
        ));
    }
}



