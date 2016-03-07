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

use yii\widgets\PjaxAsset;

/**
 * Description of Pjax
 *
 * @author vistart <i@vistart.name>
 */
class Pjax extends \yii\widgets\Pjax
{

    public function generateClientScript()
    {
        $id = $this->options['id'];
        $this->clientOptions['push'] = $this->enablePushState;
        $this->clientOptions['replace'] = $this->enableReplaceState;
        $this->clientOptions['timeout'] = $this->timeout;
        $this->clientOptions['scrollTo'] = $this->scrollTo;
        $options = Json::htmlEncode($this->clientOptions);
        $js = '';
        if ($this->linkSelector !== false) {
            $linkSelector = Json::htmlEncode($this->linkSelector !== null ? $this->linkSelector : '#' . $id . ' a');
            $js .= "jQuery(document).pjax($linkSelector, \"#$id\", $options);";
        }
        if ($this->formSelector !== false) {
            $formSelector = Json::htmlEncode($this->formSelector !== null ? $this->formSelector : '#' . $id . ' form[data-pjax]');
            $js .= "\njQuery(document).on('submit', $formSelector, function (event) {jQuery.pjax.submit(event, '#$id', $options);});";
        }
        return $js;
    }

    public function registerClientScript()
    {
        $view = $this->getView();
        PjaxAsset::register($view);
        $js = $this->generateClientScript();
        if ($js !== '') {
            $view->registerJs($js);
        }
    }
}
