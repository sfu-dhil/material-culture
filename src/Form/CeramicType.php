<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\Ceramic;
use App\Entity\Glaze;
use App\Entity\Typology;
use App\Entity\Vessel;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

/**
 * CeramicType form.
 */
class CeramicType extends ArtefactType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        parent::buildForm($builder, $options);

        $builder->add('paste', null, [
            'label' => 'Paste',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('munsell', null, [
            'label' => 'Munsell',
            'required' => false,
            'attr' => [
                'help_block' => '',
            ],
        ]);
        $builder->add('vessel', Select2EntityType::class, [
            'label' => 'Vessel',
            'multiple' => false,
            'remote_route' => 'vessel_typeahead',
            'class' => Vessel::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => [
                'add_path' => 'vessel_new_popup',
                'add_label' => 'New Vessel',
                'help_block' => '',
            ],
        ]);
        $builder->add('glaze', Select2EntityType::class, [
            'label' => 'Glaze',
            'multiple' => false,
            'remote_route' => 'glaze_typeahead',
            'class' => Glaze::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => [
                'add_path' => 'glaze_new_popup',
                'add_label' => 'New Glaze',
                'help_block' => '',
            ],
        ]);
        $builder->add('typology', Select2EntityType::class, [
            'label' => 'Typology',
            'multiple' => false,
            'remote_route' => 'typology_typeahead',
            'class' => Typology::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => [
                'add_path' => 'typology_new_popup',
                'add_label' => 'New Typology',
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
            'data_class' => Ceramic::class,
        ]);
    }
}
