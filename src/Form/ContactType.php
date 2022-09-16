<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class,[
                'label' => '',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prénom',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
            ])
            ->add('nom', TextType::class,[
                'label' => '',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => '',
                'attr' => [
                    'placeholder' => 'Votre adresse email',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
            ])
            ->add('content', TextareaType::class,[
                'label' => '',
                'attr' => [
                    'placeholder' => 'en quoi pouvons nous vous aider ?',
                    'class' =>'stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25'
                ]
            ])

            ->add('submit', SubmitType::class,[
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
