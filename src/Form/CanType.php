<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\Can;
use App\Entity\Content;
use App\Entity\Location;
use App\Entity\Manufacturer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

/**
 * CanType form.
 */
class CanType extends ArtefactType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        parent::buildForm($builder, $options);

        $builder->add('company', null, [
            'label' => 'Company',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('brand', null, [
            'label' => 'Brand',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('label', null, [
            'label' => 'Label',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('manufacturer', Select2EntityType::class, [
            'label' => 'Manufacturer',
            'multiple' => false,
            'remote_route' => 'manufacturer_typeahead',
            'class' => Manufacturer::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => [
                'add_path' => 'manufacturer_new',
                'add_label' => 'New Manufacturer',
                'help_block' => '',
            ],
        ]);
        $builder->add('packagingLocation', Select2EntityType::class, [
            'label' => 'Packaging Location',
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
        $builder->add('content', Select2EntityType::class, [
            'label' => 'Contents',
            'multiple' => false,
            'remote_route' => 'content_typeahead',
            'class' => Content::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => [
                'add_path' => 'content_new',
                'add_label' => 'New Content',
                'help_block' => '',
            ],
        ]);
        $builder->add('references', CollectionType::class, [
            'label' => 'Bibliographic References',
            'allow_add' => true,
            'allow_delete' => true,
            'allow_delete' => true,
            'prototype' => true,
            'entry_type' => ReferenceType::class,
            'entry_options' => ['label' => false],
            'required' => false,
            'attr' => [
                'help_block' => '',
                'class' => 'collection collection-complex',
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
            'data_class' => Can::class,
        ]);
    }
}
