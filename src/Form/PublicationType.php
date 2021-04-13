<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\Publication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * PublicationType form.
 */
class PublicationType extends AbstractType
{
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('title', null, [
            'label' => 'Title',
            'required' => true,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('citation', TextareaType::class, [
            'label' => 'Citation',
            'required' => true,
            'attr' => [
                'help_block' => '',
                'class' => 'tinymce',
            ],
        ]);
        $builder->add('abstract', TextareaType::class, [
            'label' => 'Abstract',
            'required' => false,
            'attr' => [
                'help_block' => '',
                'class' => 'tinymce',
            ],
        ]);
        $builder->add('urls', CollectionType::class, [
            'label' => 'URLs',
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'entry_type' => TextType::class,
            'entry_options' => ['label' => false],
            'required' => false,
            'attr' => [
                'help_block' => '',
                'class' => 'collection collection-simple',
            ],
        ]);
        $builder->add('doi', null, [
            'label' => 'Doi',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
    }

    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     */
    public function configureOptions(OptionsResolver $resolver) : void {
        $resolver->setDefaults([
            'data_class' => Publication::class,
        ]);
    }
}
