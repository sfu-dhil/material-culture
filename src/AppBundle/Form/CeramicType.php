<?php

namespace AppBundle\Form;

use AppBundle\Entity\Ceramic;
use AppBundle\Entity\Glaze;
use AppBundle\Entity\Shape;
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
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder->add('paste', null, array(
            'label' => 'Paste',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('munsell', null, array(
            'label' => 'Munsell',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('shape', Select2EntityType::class, array(
            'label' => 'Shape',
            'multiple' => false,
            'remote_route' => 'shape_typeahead',
            'class' => Shape::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => array(
                'add_path' => 'shape_new_popup',
                'add_label' => 'New Shape',
                'help_block' => '',
            ),
        ));
        $builder->add('glaze', Select2EntityType::class, array(
            'label' => 'Glaze',
            'multiple' => false,
            'remote_route' => 'glaze_typeahead',
            'class' => Glaze::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => array(
                'add_path' => 'glaze_new_popup',
                'add_label' => 'New Glaze',
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
            'data_class' => Ceramic::class,
        ));
    }
}
