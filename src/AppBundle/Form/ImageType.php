<?php

namespace AppBundle\Form;

use AppBundle\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * ImageType form.
 */
class ImageType extends AbstractType {
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
        $builder->add('originalName', null, array(
            'label' => 'Original Name',
            'required' => true,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('imageFilePath', null, array(
            'label' => 'Image File Path',
            'required' => true,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('thumbnailPath', null, array(
            'label' => 'Thumbnail Path',
            'required' => true,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('imageSize', null, array(
            'label' => 'Image Size',
            'required' => true,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('imageWidth', null, array(
            'label' => 'Image Width',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('imageHeight', null, array(
            'label' => 'Image Height',
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
            'data_class' => Image::class,
        ));
    }
}
