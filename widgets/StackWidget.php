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
     *
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
            $content .= $widget;
            if ($i != count($widgets)) {
                $content .= $this->seperator;
            }
        }
        return str_replace('{content}', $content, $this->template);
    }

    /**
     * 
     * @param array $config this array must contain `class`, optionally contain `key`.
     * @return type
     */
    public function addWidget($config = [])
    {
        if (empty($config)) {
            return null;
        }
        $class = $config['class'];
        unset($config['class']);
        if (isset($config['key'])) {
            $this->widgets[$config['key']] = new $class($config);
        } else {
            $this->widgets[] = new $class($config);
        }
    }

    /**
     * 
     * @return Widget[]
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    public function removeWidget($key)
    {
        if (array_key_exists($key, $this->widgets)) {
            unset($this->widgets[$key]);
        }
    }
}
