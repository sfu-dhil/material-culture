<?php

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
class PublicationType extends AbstractType {
    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->add('title', null, array(
            'label' => 'Title',
            'required' => true,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('citation', TextareaType::class, array(
            'label' => 'Citation',
            'required' => true,
            'attr' => array(
                'help_block' => '',
                'class' => 'tinymce',
            ),
        ));
        $builder->add('abstract', TextareaType::class, array(
            'label' => 'Abstract',
            'required' => false,
            'attr' => array(
                'help_block' => '',
                'class' => 'tinymce',
            ),
        ));
        $builder->add('urls', CollectionType::class, array(
            'label' => 'URLs',
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'entry_type' => TextType::class,
            'entry_options' => array('label' => false),
            'required' => false,
            'attr' => array(
                'help_block' => '',
                'class' => 'collection collection-simple',
            ),
        ));
        $builder->add('doi', null, array(
            'label' => 'Doi',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
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
            'data_class' => Publication::class,
        ));
    }
}
