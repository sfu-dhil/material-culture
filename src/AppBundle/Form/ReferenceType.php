<?php

namespace AppBundle\Form;

use AppBundle\Entity\Reference;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ),
        ));
        $builder->add('publication');
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
