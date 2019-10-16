<?php

namespace AppBundle\Form;

use AppBundle\Entity\Ceramic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        $builder->add('shape');
        $builder->add('glaze');
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
