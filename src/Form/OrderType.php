<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Carrier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        $builder
            ->add('addresses', EntityType::class,[
                'label' => false,
                'required' => true,
                'class' => Address::class,
                'choices' => $user->getAddresses(),
                'choice_attr' => [
                    'class'=> 'card'],
                'multiple' => false,
                'expanded' => true,
                'attr' => [
                    'class' => 'radio-toolbar'
                ]
            ])
            
            ->add('carrier', EntityType::class,[
                'label' => 'Votre transporteur',
                'required' => true,
                'class' => Carrier::class,
                'multiple' => false,
                'expanded' => false,
                'attr' => [
                    'class' => 'mtext-107 cl2 size-114 plh2 p-r-15'
                    ]
            ])

            ->add('submit', SubmitType::class,[
                'label' => 'valider ma commande',
                'attr' => [
                    'class' => 'flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer'
                    ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user' =>array()
        ]);
    }
}
