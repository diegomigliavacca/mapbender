<?php

namespace Mapbender\CoreBundle\Element;

use Mapbender\CoreBundle\Component\Element;

/**
 * A ScaleSelector
 * 
 * Displays and changes a map scale.
 * 
 * @author Paul Schmidt
 */
class ScaleSelector extends Element
{

    /**
     * @inheritdoc
     */
    public static function getClassTitle()
    {
        return "Scale Selector";
    }

    /**
     * @inheritdoc
     */
    public static function getClassDescription()
    {
        return "Displays and changes a map scale.";
    }

    /**
     * @inheritdoc
     */
    public static function getClassTags()
    {
        return array('scale', 'selector');
    }

    /**
     * @inheritdoc
     */
    public function getAssets()
    {
        return array(
            'js' => array('mapbender.element.scaleselector.js',
                '@FOMCoreBundle/Resources/public/js/frontend/components.js'),
            'css' => array()
        );
    }

    /**
     * @inheritdoc
     */
    public static function getType()
    {
        return 'Mapbender\CoreBundle\Element\Type\ScaleSelectorAdminType';
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultConfiguration()
    {
        return array(
            "target" => null,
            'label' => false,
            "tooltip" => "Scale");
    }

    /**
     * @inheritdoc
     */
    public function getWidgetName()
    {
        return 'mapbender.mbScaleSelector';
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return $this->container->get('templating')
                        ->render('MapbenderCoreBundle:Element:scaleselector.html.twig',
                                 array(
                            'id' => $this->getId(),
                            "title" => $this->getTitle(),
                            'configuration' => $this->getConfiguration()));
    }

    /**
     * @inheritdoc
     */
    public static function getFormTemplate()
    {
        return 'MapbenderManagerBundle:Element:scaleselector.html.twig';
    }
}

