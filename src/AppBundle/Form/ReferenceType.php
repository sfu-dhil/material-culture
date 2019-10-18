<?php

namespace AppBundle\Form;

use AppBundle\Entity\Publication;
use AppBundle\Entity\Reference;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

/**
 * ReferenceType form.
 */
class ReferenceType extends AbstractType {
    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('description', null, array(
            'label' => 'Description',
            'required' => false,
            'attr' => array(
                'help_block' => '',
                'class' => 'tinymce',
            ),
        ));
        $builder->add('publication', Select2EntityType::class, array(
            'label' => 'Publication',
            'multiple' => false,
            'remote_route' => 'publication_typeahead',
            'class' => Publication::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => array(
                'add_path' => 'publication_new_popup',
                'add_label' => 'New Publication',
                'help_block' => '',
            ),
        ));
        $builder->add('artefact');
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
            'data_class' => Reference::class,
        ));
    }
}
