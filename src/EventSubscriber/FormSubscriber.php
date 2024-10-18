<?php

// src/EventSubscriber/FormSubscriber.php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        // Ajoute un champ dynamique
        if (isset($data['phone']) && !empty($data['phone'])) {
            $form->add('extraField', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Champ Dynamique',
                ],
            ]);
        }
    }

    public function onPreSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        // Ajoute un champ dynamique basé sur des conditions
        if (!empty($data['surname'])) {
            $form->add('additionalField', TextType::class, [
                'required' => false,
            ]);
        }
    }
}
