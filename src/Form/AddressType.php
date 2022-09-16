<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { 
        
    
        $builder
            ->add('name', TextType::class, [
            'label' => 'Quel nom souhaitez-vous donner à votre adresse ?',
            'attr' => [
                'placeholder' => 'Nommez votre adresse',
                'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
            ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Quel est votre prénom?',
                'attr' => [
                    'placeholder' => 'Entrer votre prénom',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
                ])
            ->add('lastname', TextType::class, [
                'label' => 'Quel est votre nom?',
                'attr' => [
                    'placeholder' => 'Entrer votre nom',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
                ])
            ->add('company', TextType::class, [
                'label' => 'Votre société ',
                'required' => false ,
                'attr' => [
                    'placeholder' => '(facultatif) Entrer le nom de votre société',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
                ])
            ->add('adress', TextType::class, [
                'label' => 'Votre adresse',
                'attr' => [
                    'placeholder' => '8 rue des Lylas ...',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
                ])
            ->add('postal', TextType::class, [
                'label' => 'Votre code postal',
                'attr' => [
                    'placeholder' => 'Entrez votre code postal', 
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
                ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Votre Ville',
                    'class' =>'stext-111 cl2 plh3 size-116 p-l-62 p-r-30'
                ]
                ])
            ->add('country' ,CountryType::class, [
                'label' => 'Pays',
                'attr' => [
                    'placeholder' => 'Votre Pays'
                ]
                ] )
            ->add('phone' ,TelType::class, [
                'label' => 'Votre télephone',
                'attr' => [
                    'placeholder' => 'Entrez votre téléphone'
                ]
                ])
            ->add('submit', SubmitType::class,[
                'label' => 'Valider',
                'attr' => [
                    'class' => 'flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer'
                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
