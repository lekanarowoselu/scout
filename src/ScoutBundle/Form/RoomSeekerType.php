<?php

namespace Octopouce\CareerBundle\Form\Jobseeker;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array('label'=>'FirstName','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('lastname', TextType::class, array('label'=>'LastName','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('sex', ChoiceType::class, array('label'=>'I am a, ','choices' => array('GentleMan' => 'GentleMan','Lady' => 'Lady'),'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            //->add('dateOfBirth', 'datetime')
           // ->add('dateOfBirth', DateTimeType::class, array('attr'=> array('class' => 'formcontrol', 'style' => 'margin-bottom:15px')))
            ->add('dateOfBirth', DateType::class,  array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' =>  array(
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy'
                )
            ))
            ->add('aboutYou', TextareaType::class, array('label'=>'Describe Your Self','attr'=> array('cols' => '50', 'rows' => '20', 'class' => 'form-control', 'style' => 'margin-bottom:15px')))
//            ->add('picturePath', FileType::class, array('label'=>'Upload A picture for your profile','attr' => array('class' => 'formcontrol', 'style' => 'margin-bottom:15px')))
            ->add('file')
            ->add('telephone', TextType::class, array('label'=>'Telephone Number','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('street', TextType::class, array('label'=>'Street Address','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('city', TextType::class, array('label'=>'City','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('state', TextType::class, array('label'=>'State','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('country', TextType::class, array('label'=>'Country','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            //->add('resumePath')
            //->add('user')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Octopouce\CareerBundle\Entity\Jobseeker\Profile'
        ));
    }
}
