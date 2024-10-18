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
    /*
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
    */

    public function buildForm(FormBuilderInterface $builder, array $options): void // formulaire dynamique avec form Event
    {
        $builder
            ->add('phone', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'phone',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un numero valide'
                    ]),
                    new NotNull([
                        'message' => 'le telephone ne doit pas etre vide '
                    ]),
                    new Regex('/^([77|78|76])([0-9]{8})$/', 'Le numero de telephone doit etre au format telephone')
                ]
            ])
            ->add('Search', SubmitType::class, [
                'attr' => [
                    'class' => 'border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white font-medium rounded-md px-4 py-2'
                ]
            ]);

        $builder->addEventSubscriber(new \App\EventSubscriber\FormSubscriber());
    }

    /*formulaire dinamique avec Symfony live component,
    // src/Component/PhoneFormComponent.php
    namespace App\Component;

    use Symfony\UX\LiveComponent\DefaultActionTrait;
    use Symfony\UX\LiveComponent\LiveComponentInterface;
    use Symfony\Component\Form\FormFactoryInterface;

    class PhoneFormComponent implements LiveComponentInterface
    {
        use DefaultActionTrait;

        private $formFactory;

        public function __construct(FormFactoryInterface $formFactory)
        {
            $this->formFactory = $formFactory;
        }

        public function buildForm()
        {
            return $this->formFactory->createBuilder()
                ->add('phone', TextType::class, [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'phone',
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez renseigner un numero valide'
                        ]),
                        new NotNull([
                            'message' => 'le telephone ne doit pas etre vide '
                        ]),
                        new Regex('/^([77|78|76])([0-9]{8})$/', 'Le numero de telephone doit etre au format telephone')
                    ]
                ])
                ->add('Search', SubmitType::class, [
                    'attr' => [
                        'class' => 'border border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-white font-medium rounded-md px-4 py-2'
                    ]
                ])
                ->getForm();
        }

        public static function getComponentName(): string
        {
            return 'phone_form_component';
        }
    }
    */

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
