<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * 小部件中渲染
 * Class ListWidget
 * @package app\components
 */
class ListWidget extends Widget
{
    public $items = [];

    public function run()
    {
        // 渲染一个名为 "list" 的视图
        return $this->render('list', [
            'items' => $this->items,
        ]);
    }
}