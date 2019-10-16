<?php

namespace AppBundle\Form;

use AppBundle\Entity\Bottle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * BottleType form.
 */
abstract class ArtefactType extends AbstractType {
    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('catalogNumber', null, array(
            'label' => 'Catalog Number',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));

        $builder->add('description', null, array(
            'label' => 'Catalog Number',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));

        $builder->add('furtherReading', null, array(
            'label' => 'Further Reading',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));

        $builder->add('note', null, array(
            'label' => 'Note',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));

        $builder->add('recoveryLocation');
        $builder->add('manufactureLocation');
        $builder->add('recoveryDate');
        $builder->add('manufactureDate');
        $builder->add('institution');
    }

}
