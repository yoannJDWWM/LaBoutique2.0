<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30  
                  ]),
                'attr' => [
                    'placeholder' =>'Saisissez votre prénom',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Votre nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30  
                  ]),
                'attr' => [
                    'placeholder' =>'Saisissez votre nom',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
            ])
            ->add('email', EmailType::class,[
                'label' => 'Votre email',
                'constraints' => new Length([
                  'min' => 2,
                  'max' => 55  
                ]),
                'attr' => [
                    'placeholder' =>'Saisissez votre email',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
            ])
            ->add('password', RepeatedType::class,[
                'type' => passwordType::class,
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30  
                  ]),
                'invalid_message'=> 'Le mot de passe ainsi que la confirmation doivent être identique',
                'label' => 'Votre mot de passe',
                'required' => true,
                'first_options' => ['label' => 'Mot de passe',
                'attr' =>[
                    'placeholder' => 'merci de saisir votre mot de passe',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
            ],
                'second_options' => ['label' => 'Confirmer votre mot de passe',
                'attr' =>[
                    'placeholder' => 'merci de confirmer votre mot de passe',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
                ]
            ])
           
            ->add('submit', SubmitType::class,[
                'label' => "S'inscrire",
                'attr' => [
                    'class' => 'flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer'
                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
