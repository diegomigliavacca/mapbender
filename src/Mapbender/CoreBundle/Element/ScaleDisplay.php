<?php

namespace Mapbender\CoreBundle\Element;

use Mapbender\CoreBundle\Component\Element;

/**
 * Map's overview element
 *
 * @author Paul Schmidt
 */
class ScaleDisplay extends Element
{

    /**
     * @inheritdoc
     */
    static public function getClassTitle()
    {
        return "ScaleDisplay";
    }

    /**
     * @inheritdoc
     */
    static public function getClassDescription()
    {
        return "";
    }

    /**
     * @inheritdoc
     */
    static public function getClassTags()
    {
        return array('ScaleDisplay', "Map's scale display");
    }

    /**
     * @inheritdoc
     */
    public static function getDefaultConfiguration()
    {
        return array(
            'title' => 'Scale Display',
            'tooltip' => 'Scale Display',
            'target' => null,
            'unitPrefix' => false,
            'scalePrefix' => 'Scale = ',
            'anchor' => 'right-bottom');
    }

    /**
     * @inheritdoc
     */
    public function getWidgetName()
    {
        return 'mapbender.mbScaledisplay';
    }

    /**
     * @inheritdoc
     */
    public static function getType()
    {
        return 'Mapbender\CoreBundle\Element\Type\ScaleDisplayAdminType';
    }
    
    /**
     * @inheritdoc
     */
    public static function getFormTemplate()
    {
        return 'MapbenderCoreBundle:ElementAdmin:scaledisplay.html.twig';
    }
    
    /**
     * @inheritdoc
     */
    public function getAssets()
    {
        return array(
            'js' => array('mapbender.element.scaledisplay.js'),
            'css' => array());
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return $this->container->get('templating')
                        ->render('MapbenderCoreBundle:Element:scaledisplay.html.twig',
                                 array(
                            'id' => $this->getId(),
                            "title" => $this->getTitle(),
                            'configuration' => $this->getConfiguration()));
    }

}

