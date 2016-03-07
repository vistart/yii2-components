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

namespace vistart\components\web;

use yii\web\Request;

/**
 * Description of Request
 *
 * @author vistart <i@vistart.name>
 */
class Request extends Request
{

    public function getIsAjaxButNotPjax()
    {
        return $this->getIsAjax() && empty($_SERVER['HTTP_X_PJAX']);
    }
}
