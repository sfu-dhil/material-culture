<?php

namespace AppBundle\Form;

use AppBundle\Entity\Institution;
use AppBundle\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

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

        $builder->add('description', TextareaType::class, array(
            'label' => 'Description',
            'required' => false,
            'attr' => array(
                'help_block' => '',
                'class' => 'tinymce',
            ),
        ));

        $builder->add('furtherReading', null, array(
            'label' => 'Further Reading',
            'required' => false,
            'attr' => array(
                'help_block' => '',
                'class' => 'tinymce',
            ),
        ));

        $builder->add('note', null, array(
            'label' => 'Note',
            'required' => false,
            'attr' => array(
                'help_block' => '',
                'class' => 'tinymce',
            ),
        ));

        $builder->add('recoveryLocation', Select2EntityType::class, array(
            'label' => 'Recovery Location',
            'multiple' => false,
            'remote_route' => 'location_typeahead',
            'class' => Location::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => array(
                'add_path' => 'location_new_popup',
                'add_label' => 'New Location',
                'help_block' => '',
            ),
        ));

        $builder->add('recoveryDate', TextType::class, array(
            'label' => 'Recovery date',
            'required' => false,
            'attr' => array(
                'help_block' => 'Date ranges (1901-1903) and circas (c1902) are supported here',
            ),
        ));

        $builder->add('manufactureLocation', Select2EntityType::class, array(
            'label' => 'Manufacture Location',
            'multiple' => false,
            'remote_route' => 'location_typeahead',
            'class' => Location::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => array(
                'add_path' => 'location_new_popup',
                'add_label' => 'New Location',
                'help_block' => '',
            ),
        ));

        $builder->add('manufactureDate', TextType::class, array(
            'label' => 'Manufacture date',
            'required' => false,
            'attr' => array(
                'help_block' => 'Date ranges (1901-1903) and circas (c1902) are supported here',
            ),
        ));

        $builder->add('institution', Select2EntityType::class, array(
            'label' => 'Institution',
            'multiple' => false,
            'remote_route' => 'institution_typeahead',
            'class' => Institution::class,
            'required' => false,
            'allow_clear' => true,
            'attr' => array(
                'add_path' => 'institution_new_popup',
                'add_label' => 'New Institution',
                'help_block' => '',
            ),
        ));
    }
}
