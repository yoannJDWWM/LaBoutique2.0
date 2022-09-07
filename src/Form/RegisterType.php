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
                    'placeholder' =>'Saisissez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Votre nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30  
                  ]),
                'attr' => [
                    'placeholder' =>'Saisissez votre nom'
                ]
            ])
            ->add('email', EmailType::class,[
                'label' => 'Votre email',
                'constraints' => new Length([
                  'min' => 2,
                  'max' => 55  
                ]),
                'attr' => [
                    'placeholder' =>'Saisissez votre email'
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
                    'placeholder' => 'merci de saisir votre mot de passe'
                ]
            ],
                'second_options' => ['label' => 'Confirmer votre mot de passe',
                'attr' =>[
                    'placeholder' => 'merci de confirmer votre mot de passe'
                ]
                ]
            ])
           
            ->add('submit', SubmitType::class,[
                'label' => "S'inscrire"
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
