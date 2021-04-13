<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\Institution;
use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

/**
 * BottleType form.
 */
abstract class ArtefactType extends AbstractType
{
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('catalogNumbers', CollectionType::class, [
            'label' => 'Catalog Numbers',
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

        $builder->add('description', TextareaType::class, [
            'label' => 'Description',
            'required' => false,
            'attr' => [
                'help_block' => '',
                'class' => 'tinymce',
            ],
        ]);

        $builder->add('furtherReading', null, [
            'label' => 'Further Reading',
            'required' => false,
            'attr' => [
                'help_block' => '',
                'class' => 'tinymce',
            ],
        ]);

        $builder->add('note', null, [
            'label' => 'Note',
            'required' => false,
            'attr' => [
                'help_block' => '',
                'class' => 'tinymce',
            ],
        ]);

        $builder->add('recoveryLocation', Select2EntityType::class, [
            'label' => 'Recovery Location',
            'multiple' => false,
            'remote_route' => 'location_typeahead',
            'class' => Location::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => [
                'add_path' => 'location_new_popup',
                'add_label' => 'New Location',
                'help_block' => '',
            ],
        ]);

        $builder->add('recoveryDate', TextType::class, [
            'label' => 'Recovery date',
            'required' => false,
            'attr' => [
                'help_block' => 'Date ranges (1901-1903) and circas (c1902) are supported here',
            ],
        ]);

        $builder->add('manufactureLocation', Select2EntityType::class, [
            'label' => 'Manufacture Location',
            'multiple' => false,
            'remote_route' => 'location_typeahead',
            'class' => Location::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => [
                'add_path' => 'location_new_popup',
                'add_label' => 'New Location',
                'help_block' => '',
            ],
        ]);

        $builder->add('manufactureDate', TextType::class, [
            'label' => 'Manufacture date',
            'required' => false,
            'attr' => [
                'help_block' => 'Date ranges (1901-1903) and circas (c1902) are supported here',
            ],
        ]);

        $builder->add('institution', Select2EntityType::class, [
            'label' => 'Institution',
            'multiple' => false,
            'remote_route' => 'institution_typeahead',
            'class' => Institution::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => [
                'add_path' => 'institution_new_popup',
                'add_label' => 'New Institution',
                'help_block' => '',
            ],
        ]);
    }
}
