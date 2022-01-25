<?php

// comment out the following two lines when deployed to production
//定义全局变量
defined('YII_DEBUG') or define('YII_DEBUG', true); //开启调试模式
//if (!defined('YII_DEBUG')) {
//    define('YII_DEBUG', true);
//}
defined('YII_ENV') or define('YII_ENV', 'dev'); //开发环境

//加载composer 的自动加载器，支持了PSR-0 PSR-4
require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../common/functions.php';

//1.引入工具类Yii
//2.注册自动加载函数
//3.生成依赖注入中使用到的容器
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

//加载应用配置
$config = require __DIR__ . '/../config/web.php';

//生成应用并运行
(new yii\web\Application($config))->run();

//请求流程
/*1.用户向入口脚本 web/index.php 发起请求。

2.入口脚本加载应用配置并创建一个应用实例去处理请求。

3.应用通过请求组件解析请求的路由。

4.应用创建一个控制器实例去处理请求。

5.控制器创建一个操作实例并针对操作执行过滤器。

6.如果任何一个过滤器返回失败，则操作退出。

7.如果所有过滤器都通过，操作将被执行。

8.操作会加载一个数据模型，或许是来自数据库。

9.操作会渲染一个视图，把数据模型提供给它。

10.渲染结果返回给响应组件。

11.响应组件发送渲染结果给用户浏览器。*/
