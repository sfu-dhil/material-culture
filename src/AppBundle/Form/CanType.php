<?php

namespace AppBundle\Form;

use AppBundle\Entity\Can;
use AppBundle\Entity\Content;
use AppBundle\Entity\Manufacturer;
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
    public function buildForm(FormBuilderInterface $builder, array $options) {
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
        $builder->add('content', Select2EntityType::class, array(
            'label' => 'Content',
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