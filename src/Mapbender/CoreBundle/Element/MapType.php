<?php

namespace Mapbender\CoreBundle\Element;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MapType extends AbstractType {
    public function getName() {
        return 'map_element';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('dpi', 'number', array(
            'precision' => 0));
    }
}

