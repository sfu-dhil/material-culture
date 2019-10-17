<?php

namespace AppBundle\Form;

use AppBundle\Entity\Can;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        $builder->add('manufacturer');
        $builder->add('content');
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
