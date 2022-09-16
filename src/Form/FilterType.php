<?php

namespace App\Form;

use App\Classes\Filter;
use App\Classes\Search;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FilterType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
         ->add('string', TextType::class,[
            'label' => false,
            'required' => false,
            'attr' =>[
                'placeholder' =>'Votre recherche...',
                'class' => 'mtext-107 cl2 size-114 plh2 p-r-15'
            ]
            ]);
            

        // ->add('categories', EntityType::class,[
        //         'label' => false,
        //         'required' => false,
        //         'class' => Category::class,
        //         'multiple' => true,
        //         'expanded' => true

        //         ])

        // ->add('submit', SubmitType::class,[
        //     'label' => 'filtrer',
        //     'attr' => ['class' => 'btn-block btn-primary']
        // ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filter::class,
            'id' => 'filterform',
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }
    
    public function getBlockPrefix(){
        return '';
    }
}

