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

use yii\di\Container;
use yii\helpers\ArrayHelper;
use Yii;
use yii\db\Connection;

/**
 * Description of TestCase
 *
 * @author vistart <i@vistart.name>
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{

    public function sleep($seconds = 1)
    {
        for ($i = $seconds; $i > 0; $i--) {
            echo "$i\n";
            sleep(1);
        }
    }

    public static $params;

    /**
     * Returns a test configuration param from /data/config.php
     * @param  string $name params name
     * @param  mixed $default default value to use when param is not set.
     * @return mixed  the value of the configuration param
     */
    public static function getParam($name, $default = null)
    {
        if (static::$params === null) {
            static::$params = require(__DIR__ . '/data/config.php');
        }

        return isset(static::$params[$name]) ? static::$params[$name] : $default;
    }

    /**
     * Clean up after test.
     * By default the application created with [[mockApplication]] will be destroyed.
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->destroyApplication();
    }

    /**
     * Populates Yii::$app with a new application
     * The application will be destroyed on tearDown() automatically.
     * @param array $config The application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected function mockApplication($config = [], $appClass = '\yii\console\Application')
    {
        new $appClass(ArrayHelper::merge([
                'id' => 'testapp',
                'basePath' => __DIR__,
                'vendorPath' => dirname(__DIR__) . '/vendor',
                ], $config));
    }

    protected function mockWebApplication($config = [], $appClass = '\vistart\components\web\Application')
    {
        new $appClass(ArrayHelper::merge([
                'id' => 'testapp',
                'basePath' => __DIR__,
                'vendorPath' => dirname(__DIR__) . '/vendor',
                'components' => [
                    'request' => [
                        'cookieValidationKey' => 'wefJDF8sfdsfSDefwqdxj9oq',
                        'scriptFile' => __DIR__ . '/index.php',
                        'scriptUrl' => '/index.php',
                    ],
                ]
                ], $config));
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        Yii::$app = null;
        Yii::$container = new Container();
    }

    protected function setUp()
    {
        $this->mockWebApplication();

        parent::setUp();
    }

    /**
     * @param  boolean    $reset whether to clean up the test database
     * @return Connection
     */
    public function getConnection($reset = true)
    {
        $databases = self::getParam('databases');
        $params = isset($databases['mysql']) ? $databases['mysql'] : [];
        $db = new Connection($params);
        if ($reset) {
            $db->open();
            //$db->flushdb();
        }

        return $db;
    }
}
