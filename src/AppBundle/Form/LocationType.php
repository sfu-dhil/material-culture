<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * LocationType form.
 */
class LocationType extends AbstractType {
    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('geonameId', null, array(
            'label' => 'Geoname Id',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('latitude', null, array(
            'label' => 'Latitude',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('longitude', null, array(
            'label' => 'Longitude',
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
            'data_class' => 'AppBundle\Entity\Location',
        ));
    }
}
