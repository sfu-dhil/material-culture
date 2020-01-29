<?php

namespace AppBundle\Form;

use AppBundle\Entity\Artefact;
use AppBundle\Entity\Publication;
use AppBundle\Entity\Reference;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

/**
 * ReferenceType form.
 */
class ReferencesType extends AbstractType {
    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('references', CollectionType::class, array(
            'label' => 'References',
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'entry_type' => ReferenceType::class,
            'entry_options' => array(
                'label' => false,
            ),
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
            'data_class' => Artefact::class,
        ));
    }
}
