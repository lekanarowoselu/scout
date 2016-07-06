<?php

namespace AppBundle\Form;

use AppBundle\Entity\Image;
use AppBundle\Repository\ImageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SliderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
           // ->add('sorting')
//            ->add('createdAt', 'datetime')
//            ->add('updatedAt', 'datetime')
            ->add('enabled')
//            ->add('translations')
//            ->add('lang')
//            ->add('images')

            ->add('images', EntityType::class, array(
                'class' => 'AppBundle\Entity\Image',
                //'choice_label' => 'name',
                'choice_label' => function ($value, $key, $index) {
//                        if ($value == true) {
//                            return 'Definitely!';
//                        }
//                    return '<img src="bundles/app/assets/images/sliders/'. $value .'" alt="checkcheck" >';
                    return $value;
                       // return strtoupper($key);

                        // or if you want to translate some key
                        //return 'form.choice.'.$key;
                    },
                'placeholder' => 'Choose your images',
                'expanded' => true,
                'multiple' => true,
                'label' => 'Select images',
                'query_builder' => function(ImageRepository $qb ){
                    return $qb->createQueryBuilder('jc');
                }
            ))
                ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Slider',
           // 'locale'=> 'en'
        ));
    }
}
