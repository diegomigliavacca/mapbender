<?php

namespace Mapbender\CoreBundle\Element;

use Mapbender\CoreBundle\Component\Element;

/**
 * Spatial reference system selector
 * 
 * Changes the map spatial reference system
 * 
 * @author Paul Schmidt
 */
class SrsSelector extends Element
{

    /**
     * @inheritdoc
     */
    public static function getClassTitle()
    {
        return 'Spatial Reference System Selector';
    }

    /**
     * @inheritdoc
     */
    public static function getClassDescription()
    {
        return "The spatial reference system selector changes the map's
            spatial reference system.";
    }

    /**
     * @inheritdoc
     */
    public static function getClassTags()
    {
        return array('spatial', 'reference', 'system', 'selector');
    }

    /**
     * @inheritdoc
     */
    public static function getType()
    {
        return 'Mapbender\CoreBundle\Element\Type\SrsSelectorAdminType';
    }

    /**
     * @inheritdoc
     */
    public function getAssets()
    {
        return array(
            'js' => array(
                'mapbender.element.srsselector.js',
                '@FOMCoreBundle/Resources/public/js/frontend/components.js',
                'proj4js/proj4js-compressed.js'),
            'css' => array()
        );
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultConfiguration()
    {
        return array(
            "tooltip" => "SRS Selector",
            'label' => false,
            "target" => null);
    }

    /**
     * @inheritdoc
     */
    public function getWidgetName()
    {
        return 'mapbender.mbSrsSelector';
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return $this->container->get('templating')
                        ->render('MapbenderCoreBundle:Element:srsselector.html.twig',
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
        return 'MapbenderManagerBundle:Element:srsselector.html.twig';
    }

}