<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link https://vistart.name/
 * @copyright Copyright (c) 2016 vistart
 * @license https://vistart.name/license/
 */

namespace vistart\components\widgets;

use Yii;
use yii\base\Widget;

/**
 * Description of StackWidget
 *
 * @author vistart <i@vistart.name>
 */
class StackWidget extends Widget
{

    const EVENT_INIT = 'init';
    const EVENT_RUN = 'run';

    /**
     * Holds all added widgets
     * 'key' => [
     *     'class' => <class>
     *     <other options>
     * ]
     * @var Widget[]
     */
    protected $widgets = [];

    /**
     * Seperator HTML Code (glue)
     *
     * @var String
     */
    public $seperator = "";

    /**
     * Template for output
     * The placeholder {content} will used to add content.
     *
     * @var String
     */
    public $template = "{content}";

    /**
     * Initializes the sidebar widget.
     */
    public function init()
    {
        $this->trigger(self::EVENT_INIT);
        return parent::init();
    }

    public function run()
    {

        $this->trigger(self::EVENT_RUN);

        $content = "";
        $i = 0;
        $widgets = $this->getWidgets();
        foreach ($widgets as $widget) {
            $i++;
            $content .= $widget->run();
            if ($i != count($widgets)) {
                $content .= $this->seperator;
            }
        }
        return str_replace('{content}', $content, $this->template);
    }

    /**
     * @param string|integer
     * @param array $config this array must contain `class`, optionally contain `key`.
     */
    public function addWidget($key = null, $config = [])
    {
        if (empty($config)) {
            return null;
        }
        if ($key === null) {
            $this->widgets[] = $config;
        } else {
            $this->widgets[$key] = $config;
        }
    }

    public function removeWidget($key)
    {
        if (array_key_exists($key, $this->widgets)) {
            unset($this->widgets[$key]);
        }
    }

    /**
     * 
     * @return Widget[]
     */
    public function getWidgets()
    {
        $widgetsConfig = $this->widgets;
        $widgets = [];
        foreach ($widgetsConfig as $key => $w) {
            if (!is_array($w)) {
                continue;
            }
            $class = '';
            if (isset($w['class'])) {
                $class = $w['class'];
                unset($w['class']);
            } else {
                $class = \yii\base\Widget::className();
            }
            try {
                $widgets[$key] = new $class($w);
            } catch (\Exception $ex) {
                
            }
        }
        return $widgets;
    }

    public function setWidgets($configs = [])
    {
        if (!is_array($configs)) {
            return null;
        }
        return $this->widgets = $configs;
    }
}
