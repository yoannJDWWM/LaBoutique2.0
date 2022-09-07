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
                'placeholder' => 'Nommez votre adresse'
            ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Quel est votre prénom?',
                'attr' => [
                    'placeholder' => 'Entrer votre prénom'
                ]
                ])
            ->add('lastname', TextType::class, [
                'label' => 'Quel est votre nom?',
                'attr' => [
                    'placeholder' => 'Entrer votre nom'
                ]
                ])
            ->add('company', TextType::class, [
                'label' => 'Votre société ',
                'required' => false ,
                'attr' => [
                    'placeholder' => '(facultatif) Entrer le nom de votre société'
                ]
                ])
            ->add('adress', TextType::class, [
                'label' => 'Votre adresse',
                'attr' => [
                    'placeholder' => '8 rue des Lylas ...'
                ]
                ])
            ->add('postal', TextType::class, [
                'label' => 'Votre code postal',
                'attr' => [
                    'placeholder' => 'Entrez votre code postal'
                ]
                ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Votre Ville'
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
                    'class' => 'btn-block btn-info'
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
