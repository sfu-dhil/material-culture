<?php

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
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        parent::buildForm($builder, $options);

        $builder->add('company', null, array(
            'label' => 'Company',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('brand', null, array(
            'label' => 'Brand',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('label', null, array(
            'label' => 'Label',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('manufacturer', Select2EntityType::class, array(
            'label' => 'Manufacturer',
            'multiple' => false,
            'remote_route' => 'manufacturer_typeahead',
            'class' => Manufacturer::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => array(
                'add_path' => 'manufacturer_new',
                'add_label' => 'New Manufacturer',
                'help_block' => '',
            ),
        ));
        $builder->add('packagingLocation', Select2EntityType::class, array(
            'label' => 'Packaging Location',
            'multiple' => false,
            'remote_route' => 'location_typeahead',
            'class' => Location::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => array(
                'add_path' => 'location_new_popup',
                'add_label' => 'New Location',
                'help_block' => '',
            ),
        ));
        $builder->add('content', Select2EntityType::class, array(
            'label' => 'Contents',
            'multiple' => false,
            'remote_route' => 'content_typeahead',
            'class' => Content::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => array(
                'add_path' => 'content_new',
                'add_label' => 'New Content',
                'help_block' => '',
            ),
        ));
        $builder->add('references', CollectionType::class, array(
            'label' => 'Bibliographic References',
            'allow_add' => true,
            'allow_delete' => true,
            'allow_delete' => true,
            'prototype' => true,
            'entry_type' => ReferenceType::class,
            'entry_options' => array('label' => false),
            'required' => false,
            'attr' => array(
                'help_block' => '',
                'class' => 'collection collection-complex',
            )
        ));
    }

    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Can::class,
        ));
    }
}
