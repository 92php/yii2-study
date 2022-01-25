<?php
namespace app\components;

use yii\base\Action;

/**
 * 创建一个独立操作类
 * Class HelloWorldAction
 * @package app\components
 */
class HelloWorldAction extends Action
{
    public function run()
    {
        return "Hello World";
    }
}