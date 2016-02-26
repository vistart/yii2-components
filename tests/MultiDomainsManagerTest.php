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

namespace vistart\components\tests;

use Yii;

/**
 * 
 * @author vistart <i@vistart.name>
 */
class MultiDomainsManagerTest extends TestCase
{

    /**
     * @group md
     */
    public function testInit()
    {
        
    }

    /**
     * @depends testInit
     * @group md
     */
    public function testNew()
    {
        $MultiDomainsManager = \Yii::$app->multiDomainsManager;
        $urlManager = $MultiDomainsManager->current;
        $myUrlManager = $MultiDomainsManager->get('my');
        $miUrlManager = $MultiDomainsManager->get('mi');
        $this->assertNull($miUrlManager);
        $mUrlManager = $MultiDomainsManager->get('m');
        $this->assertNull($mUrlManager);
        $mhUrlManager = $MultiDomainsManager->get('mh');
    }

    /**
     * @depends testNew
     * @group md
     */
    public function testSSO()
    {
        
    }
}
