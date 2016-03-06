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

/**
 * Description of ActiveForm
 *
 * @author vistart <i@vistart.name>
 */
class ActiveForm extends \yii\widgets\ActiveForm
{

    public function getPublicClientOptions()
    {
        return $this->getClientOptions();
    }
}
