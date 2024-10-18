<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;

class ClientType extends AbstractType
{
    /* public function buildForm(FormBuilderInterface $builder, array $options): void
    // {
    //     $builder
    //         ->add('phone', TextType::class,[
    //             'required'=> false, 
    //             'attr' => [
    //                 'placeholder'=> '773893258',
    //                 // 'pattern' => '^([77|78|76])[0-9]{7}$',
    //                 // 'class' => 'text-danger'
    //             ],
    //             'constraints' => [
    //                 new NotBlank([
    //                     'message'=> 'Veuillez renseigner un numero valide'
    //                 ]),
    //                 new NotNull([
    //                     'message'=> 'le telephone ne doit pas etre vide '
    //                 ]),
    //                 new Regex('/^([77|78|76])([0-9]{8})$/',
    //                     'Le numero de telephone doit conformer au format telephone'
    //                 )
    //             ]
    //             ])
                
    //         ->add('surname', TextType::class,[
    //             'required'=> false,
    //         ])
    //         ->add('adresse', TextareaType::class,[
    //             'required'=> false,
    //         ])
    //         // ->add('createAt', null, [
    //         //     'widget' => 'single_text',
    //         // ])
    //         // ->add('updateAt', null, [
    //         //     'widget' => 'single_text',
    //         // ])
    //         // ->add('users', EntityType::class, [
    //         //     'class' => User::class,
    //         //     'choice_label' => 'id',
    //         // ])
    //         ->add('Save', SubmitType::class)
    //     ;
    // }
    */

    
    public function buildForm(FormBuilderInterface $builder, array $options): void // formulaire dynamique avec form Event
    {
        $builder
            ->add('phone', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => '773893258',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un numero valide'
                    ]),
                    new NotNull([
                        'message' => 'le telephone ne doit pas etre vide '
                    ]),
                    new Regex('/^([77|78|76])([0-9]{8})$/', 'Le numero de telephone doit conformer au format telephone')
                ]
            ])
            ->add('surname', TextType::class, [
                'required' => false,
            ])
            ->add('adresse', TextareaType::class, [
                'required' => false,
            ])
            ->add('Save', SubmitType::class);

        $builder->addEventSubscriber(new \App\EventSubscriber\FormSubscriber());
    }

    /*formulaire dynamique avec Symfony live component
        
        // src/Component/FormComponent.php
        namespace App\Component;
        use Symfony\UX\LiveComponent\DefaultActionTrait;
        use Symfony\UX\LiveComponent\LiveComponentInterface;
        use Symfony\Component\Form\FormFactoryInterface;

        class FormComponent implements LiveComponentInterface
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
                            'placeholder' => '773893258',
                        ],
                        'constraints' => [
                            new NotBlank([
                                'message' => 'Veuillez renseigner un numero valide'
                            ]),
                            new NotNull([
                                'message' => 'le telephone ne doit pas etre vide '
                            ]),
                            new Regex('/^([77|78|76])([0-9]{8})$/', 'Le numero de telephone doit conformer au format telephone')
                        ]
                    ])
                    ->add('surname', TextType::class, [
                        'required' => false,
                    ])
                    ->add('adresse', TextareaType::class, [
                        'required' => false,
                    ])
                    ->add('Save', SubmitType::class)
                    ->getForm();
            }

            public static function getComponentName(): string
            {
                return 'form_component';
            }
        }

    */
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
