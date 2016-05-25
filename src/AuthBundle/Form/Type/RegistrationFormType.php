<?php
// src/Octopouce/AuthBundle/Form/Type/RegistrationFormType.php

namespace Octopouce\AuthBundle\Form\Type;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationFormType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
    ->add('usertype', ChoiceType::class, array('label'=>'I am a, ','choices' => array('Job Seeker' => '2','Company' => '3'),'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
    ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))

    ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
    ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
        'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
        'options' => array('translation_domain' => 'FOSUserBundle'),
        'first_options' => array('label' => 'form.password', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')),
        'second_options' => array('label' => 'form.password_confirmation', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')),
        'invalid_message' => 'fos_user.password.mismatch',
    ))


;
}

public function getParent()
{
return 'FOS\UserBundle\Form\Type\RegistrationFormType';

// Or for Symfony < 2.8
// return 'fos_user_registration';
}

public function getBlockPrefix()
{
return 'auth_user_registration';
}

// For Symfony 2.x
public function getName()
{
return $this->getBlockPrefix();
}
}