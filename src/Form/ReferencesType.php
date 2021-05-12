<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Form;

use App\Entity\Artefact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * ReferenceType form.
 */
class ReferencesType extends AbstractType {
    /**
     * Add form fields to $builder.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('references', CollectionType::class, [
            'label' => 'References',
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'entry_type' => ReferenceType::class,
            'entry_options' => [
                'label' => false,
            ],
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
            'data_class' => Artefact::class,
        ]);
    }
}
