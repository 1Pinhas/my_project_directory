<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;

class SearchClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('phone', TextType::class,[
            'required'=> false, 
            'attr' => [
                'placeholder'=> 'phone',
                // 'pattern' => '^([77|78|76])[0-9]{7}$',
                // 'class' => 'text-danger'
            ],
            'constraints' => [
                new NotBlank([
                    'message'=> 'Veuillez renseigner un numero valide'
                ]),
                new NotNull(options: [
                    'message'=> 'le telephone ne doit pas etre vide '
                ]),
                new Regex('/^([77|78|76])([0-9]{8})$/',
                    'Le numero de telephone doit etre au format telephone'
                )
            ]
            ])
        ->add('Search', SubmitType::class,[
            'attr' => [
                'class'=> 'border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white font-medium rounded-md px-4 py-2'
            ]

        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
