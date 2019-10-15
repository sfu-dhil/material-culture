<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * BottleType form.
 */
class BottleType extends AbstractType {
    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
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
            'data_class' => 'AppBundle\Entity\Bottle',
        ));
    }
}
