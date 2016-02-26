<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link http://vistart.name/
 * @copyright Copyright (c) 2016 vistart
 * @license http://vistart.name/license/
 */

namespace vistart\components\web;

/**
 * Description of Application
 *
 * @author vistart <i@vistart.name>
 */
class Application extends \yii\web\Application
{

    public function getMultiDomainsManager()
    {
        return $this->get('multiDomainsManager');
    }

    public function coreComponents()
    {
        return array_merge(parent::coreComponents(), [
            'multiDomainsManager' => ['class' => 'vistart\components\web\MultiDomainsManager'],
            'user' => ['class' => 'vistart\components\web\SSOUser'],
        ]);
    }
}
