<?php

namespace Mapbender\CoreBundle\Element\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Mapbender\CoreBundle\Form\Type\PositionType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * 
 */
class ZoomBarAdminType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'zoombar';
    }

    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'application' => null
        ));
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('tooltip', 'text', array('required' => false))
            ->add('components', 'choice',
                array(
                'required'          => true,
                'multiple'          => true,
                'choices'           => array(
                    "pan"         => "pan",
                    "history"     => "history",
                    "zoom_box"    => "zoom box",
                    "zoom_max"    => "zoom to max extent",
                    "zoom_slider" => "zoom slider")))
            ->add('target', 'target_element',
                array(
                'element_class' => 'Mapbender\\CoreBundle\\Element\\Map',
                'application'   => $options['application'],
                'property_path' => '[target]',
                'required'      => false))
            ->add('stepSize', 'text', array('required' => false))
            ->add('stepByPixel', 'choice',
                array(
                'choices' => array('true'  => 'true', 'false' => 'false')))
            ->add('anchor', "choice",
                array(
                'required' => true,
                "choices"  => array(
                    'inline'       => 'inline',
                    'left-top'     => 'left-top',
                    'left-bottom'  => 'left-bottom',
                    'right-top'    => 'right-top',
                    'right-bottom' => 'right-bottom')))
            ->add('draggable', 'checkbox', array('required' => false));
    }

}