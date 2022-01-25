<?php
namespace app\components;

use Yii;
use yii\base\ActionFilter;

/**
 * 一个记录动作执行时间日志的过滤器
 * Class ActionTimeFilter
 * @package app\components
 */
class ActionTimeFilter extends ActionFilter
{
    private $_startTime;

    public function beforeAction($action)
    {
        $this->_startTime = microtime(true);
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        $time = microtime(true) - $this->_startTime;
        Yii::debug("Action '{$action->uniqueId}' spent $time second.");
        return parent::afterAction($action, $result);
    }
}