<?php

namespace app\controllers;

use app\models\EntryForm;
use Imagine\Image\ManipulatorInterface;
use yii\web\Controller;
use app\models\Article;
use yii\db\Query;
use app\models\Country;
use yii\imagine\Image;
use app\components\DownloadJob;
use yii\helpers\Url;
use app\components\MyClass;
use app\components\Foo;

class TestController extends Controller
{

    public function actionTest()
    {
        $model = new EntryForm();
        $model->name = 'Qiang';
        //$model->email = 'bad';
        $model->email = '812178731@qq.com';
        if ($model->validate()) {
            // 验证成功！
            var_dump("验证成功！");
        } else {
            // 失败！
            // 使用 $model->getErrors() 获取错误详情
            var_dump($model->getErrors());
        }
    }

    public function actionTest1()
    {
        // 获取 country 表的所有行并以 name 排序
        $countries = Country::find()->orderBy('name')->asArray()->all();
        //var_dump($countries);

        // 获取主键为 “US” 的行
        $country = Country::findOne('US');
        //var_dump($country);

        // 输出 “United States”
        echo $country->name;

        // 修改 name 为 “U.S.A.” 并在数据库中保存更改
        $country->name = 'U.S.A.';
        $country->save();
    }

    public function actionTest2()
    {
        $a = \Yii::$app->components;
        dump($a);
    }

    public function actionTest3()
    {
        $srcImg = \Yii::getAlias('@webroot/img/test.jpg');
        $aimImg = \Yii::getAlias('@webroot/img/testdeal.jpg');
        $aimImg1 = \Yii::getAlias('@webroot/img/testdeal_a.jpg');
        $aimImg2 = \Yii::getAlias('@webroot/img/testdeal_b.jpg');
        $aimImg3 = \Yii::getAlias('@webroot/img/testdeal_c.jpg');
        $aimImg4 = \Yii::getAlias('@webroot/img/testdeal_d.jpg');
        $aimImg5 = \Yii::getAlias('@webroot/img/testdeal_e.jpg');
        $srcTTF = \Yii::getAlias('@webroot/img/symbol.ttf');
        //dump($srcImg);

        // 缩略
        // 参数 inset 表示定框缩略
        // 图片完整缩略在 200x100 的框内
        // 备注：定框的宽度或高度必须有一个小于图片的实际尺寸，否则直接返回源图尺寸
        //$a = Image::thumbnail($srcImg, 200, 100,ManipulatorInterface::THUMBNAIL_INSET)->save($aimImg, ['quality'=>100]);
        //dump($a);

        // 缩略
        // 参数 outbound 表示单尺寸优先缩略并居中截取
        // 该参数为函数的默认值，它会为您尽可能多的截取图片但又不会超出图片范围
        // 例：源图 500x200，那么按照高度 100 缩略（变为250x100），然后再居中截取 200x100
        // 例：源图 400x350，那么按照宽度 200 缩率（变为200x175），然后再居中截取 200x100
        // 例：源图 100x80，那么不缩率不截取，直接返回源图 100x80
        //$a = Image::thumbnail($srcImg, 200, 100, ManipulatorInterface::THUMBNAIL_OUTBOUND)->save($aimImg1, ['quality'=>100]);
        //dump($a);

        // 缩略
        // 按宽度 200 缩略，高度自适应
        //$a = Image::thumbnail($srcImg, 200, null)->save($aimImg2, ['quality'=>100]);
        //dump($a);

        // 缩略
        // 按高度 100 缩略，宽度自适应
        //$a = Image::thumbnail($srcImg, null, 100)->save($aimImg3, ['quality'=>100]);
        //dump($a);

        // 剪切
        // 参数：源图、宽度、高度、起始点
        // 将源文件 $srcImg 保存到 $aimImg
        //$a = Image::crop($srcImg, 400, 200, [100,100])->save($aimImg4);
        //dump($a);

        // 旋转
        //$a = Image::frame('@webroot/img/test-image.jpg', 5, '666', 0)->rotate(-8)->save(\Yii::getAlias('@webroot/img/thumb-test.jpg'), ['quality' => 100]);
        //dump($a);

        // 水印
        //$a = Image::watermark('@webroot/img/test-image.jpg', '@webroot/img/watermark.jpg', [10,10])->save(\Yii::getAlias('@webroot/img/thumb-test-watermark.jpg'), ['quality' => 100]);
        //dump($a);

        // 文字水印
        // 参数：源图、文字、字体、起始点、字体配置
        $a = Image::text($srcImg, 'hello world', $srcTTF, [100,100] ,['color'=>'000000','size'=>50])->save($aimImg5, ['quality'=>100]);
        dump($a);
    }

    public function actionTest4()
    {
        //$source = \Yii::$app->redis->set('var1','asdasd1');
        //dump($source);

        //$source = \Yii::$app->redis->get('var1');
        //dump($source);

        //$source = \Yii::$app->redis->del('var1');
        //dump($source);

        //$var2 = \Yii::$app->redis->keys("*");
        //dump($var2);

        //$var1 = \Yii::$app->redis->lpush("vari","lisr");
        //dump($var1);

        //$var3 = \Yii::$app->redis->lrange("vari",0,2);
        //dump($var3);

        //$var33 = \Yii::$app->redis->lset('vari',2,'2323');
        //dump($var33);

        //$var333 = \Yii::$app->redis->lrange('vari',0,-1);
        //dump($var333);

        //$var4 = \Yii::$app->redis->hmset('mioji','name','syc','age','24');
        //$var5 = \Yii::$app->redis->hgetall('mioji');
        //dump($var5);

        /*$var6 = \Yii::$app->redis->sadd('mioji1','lgc','lr','yzb','syc');
        $var60 = \Yii::$app->redis->scard('mioji1');
        dump( $var60);
        $var61 = \Yii::$app->redis->smembers('mioji1');
        dump($var61);*/


        /*$var8 = \Yii::$app->redis->zadd('mioji2','1','zf','2','ls');
        $var81 = \Yii::$app->redis->zcard('mioji2');
        dump($var81);
        $var82 = \Yii::$app->redis->zrange('mioji2',0,2);
        dump($var82);*/


        //$var7 = \Yii::$app->redis->psubscribe('redisChat');
        //dump($var7);

    }

    public function actionTest5()
    {
        //注意：yii queue/run  配置要写在console.php中
        $aimImg = \Yii::getAlias('@webroot/img/image.jpeg');
        $a = \Yii::$app->queue->push(new DownloadJob([
            'url' => 'https://pic1.shejiben.com/case/2021/11/05/20211105103232-80214345-2s.jpeg',
            'file' => $aimImg,
        ]));
        dump($a);
    }

    public function actionTest6()
    {
        // Url::to() 将调用 UrlManager::createUrl() 来创建URL
        $url = Url::to(['post/view', 'id' => 100]);
        dump($url);

        \Yii::setAlias('@example', 'http://example.com/');
        $url = Url::to('@example');
        dump($url);

        $url = Url::home();
        dump($url);

        $url = Url::base();
        dump($url);

        $url = Url::canonical();
        dump($url);

        $url = Url::remember();
        dump($url);

    }

    public function actionTest7()
    {
        $request = \Yii::$app->request;

        $get = $request->get();
        // 等价于: $get = $_GET;
        dump($get);

        $id = $request->get('id');
        // 等价于: $id = isset($_GET['id']) ? $_GET['id'] : null;
        dump($id);

        $id = $request->get('id', 1);
        // 等价于: $id = isset($_GET['id']) ? $_GET['id'] : 1;
        dump($id);

        $post = $request->post();
        // 等价于: $post = $_POST;
        dump($post);

        $name = $request->post('name');
        // 等价于: $name = isset($_POST['name']) ? $_POST['name'] : null;
        dump($name);

        $name = $request->post('name', '');
        // 等价于: $name = isset($_POST['name']) ? $_POST['name'] : '';
        dump($name);

        // 返回所有参数
        $params = $request->bodyParams;
        dump($params);

        // 返回参数 "id"
        $param = $request->getBodyParam('id');
        dump($params);

        $userHost = \Yii::$app->request->userHost;
        dump($userHost);
        $userIP = \Yii::$app->request->userIP;
        dump($userIP);

    }

    public function actionTest8()
    {
        $session = \Yii::$app->session;
        dump($session);

        // 设置一个session变量，以下用法是相同的：
        $session->set('language', 'en-US');
        $session['language1'] = 'en-US1';
        $_SESSION['language2'] = 'en-US2';

        // 获取session中的变量值，以下用法是相同的：
        $language = $session->get('language');
        dump($language);
        $language = $session['language1'];
        dump($language);
        $language = isset($_SESSION['language2']) ? $_SESSION['language2'] : null;
        dump($language);

        // 删除一个session变量，以下用法是相同的：
        $session->remove('language');
        unset($session['language1']);
        unset($_SESSION['language2']);

        // 检查session变量是否已存在，以下用法是相同的：
        if ($session->has('language')){
            dump(1);
        }
        if (isset($session['language1'])) {
            dump(2);
        }
        if (isset($_SESSION['language2'])) {
            dump(3);
        }

        // 遍历所有session变量，以下用法是相同的：
        foreach ($session as $name => $value) {
        }
        foreach ($_SESSION as $name => $value) {
        }
    }

    public function actionTest9()
    {
        // 从 "response" 组件中获取 cookie 集合(yii\web\CookieCollection)
        $cookies = \Yii::$app->response->cookies;
        dump($cookies);

        // 在要发送的响应中添加一个新的 cookie
        $cookies->add(new \yii\web\Cookie([
            'name' => 'language',
            'value' => 'zh-CN',
        ]));

        // 获取名为 "language" cookie 的值，如果不存在，返回默认值 "en"
        $language = $cookies->getValue('language', 'en');
        dump($language);

        // 另一种方式获取名为 "language" cookie 的值
        if (($cookie = $cookies->get('language')) !== null) {
            $language = $cookie->value;
            dump($language);
        }

        // 可将 $cookies 当作数组使用
        if (isset($cookies['language'])) {
            $language = $cookies['language']->value;
            dump($language);
        }

        // 判断是否存在名为 "language" 的 cookie
        if ($cookies->has('language')) {
            dump(1);
        }
        if (isset($cookies['language'])){
            dump(2);
        }

        dump($cookies);
        // 删除一个 cookie
        $a = $cookies->remove('language');
        dump($a);
        dump($cookies);
        // 等同于以下删除代码
        unset($cookies['language']);
    }

    public function actionTest10()
    {
        $component = new MyClass(1, 2, ['prop1' => 3, 'prop2' => 4]);
        dump($component);
        // 方法二：
        $component = \Yii::createObject([
            'class' => MyClass::class,
            'prop1' => 3,
            'prop2' => 4,
        ], [1, 2]);
        dump($component);
    }

    public function actionTest11()
    {
        $object = new Foo();
        // 等效于 $label = $object->getLabel();
        $label = $object->label;
        dump($label);

        // 等效于 $object->setLabel('abc');
        $object->label = 'abc';
        dump($object);
    }

    public function actionTest12()
    {
        // 返回多行. 每行都是列名和值的关联数组.
        // 如果该查询没有结果则返回空数组
        $res = \Yii::$app->db->createCommand('SELECT * FROM article')
            ->queryAll();
        dump($res);

        // 返回一行 (第一行)
        // 如果该查询没有结果则返回 false
        $res = \Yii::$app->db->createCommand('SELECT * FROM article WHERE id=1')
            ->queryOne();
        dump($res);

        // 返回一列 (第一列)
        // 如果该查询没有结果则返回空数组
        $res = \Yii::$app->db->createCommand('SELECT title FROM article')
            ->queryColumn();
        dump($res);

        // 返回一个标量值
        // 如果该查询没有结果则返回 false
        $count = \Yii::$app->db->createCommand('SELECT COUNT(*) FROM article')
            ->queryScalar();
        dump($count);

        $id = 1;
        $res = \Yii::$app->db->createCommand('SELECT * FROM article WHERE id=:id AND status=:status')
            ->bindValue(':id', $id)
            ->bindValue(':status', 1)
            ->queryOne();
        dump($res);

        $params = [':id' => 1, ':status' => 1];
        $res = \Yii::$app->db->createCommand('SELECT * FROM article WHERE id=:id AND status=:status')
            ->bindValues($params)
            ->queryOne();
        dump($res);

        $res = \Yii::$app->db->createCommand('SELECT * FROM article WHERE id=:id AND status=:status', $params)
            ->queryOne();
        dump($res);

        $command = \Yii::$app->db->createCommand('SELECT * FROM article WHERE id=:id');
        $res1 = $command->bindValue(':id', 1)->queryOne();
        $res2 = $command->bindValue(':id', 2)->queryOne();
        dump($res1);
        dump($res2);

        \Yii::$app->db->createCommand('UPDATE article SET status=1 WHERE id=1')
            ->execute();

        // INSERT (table name, column values)
        \Yii::$app->db->createCommand()->insert('article', [
            'title' => 'Sam',
            'desc' => '30',
            'content' => '30',
        ])->execute();

        // UPDATE (table name, column values, condition)
        \Yii::$app->db->createCommand()->update('article', ['status' => 1], 'click > 200')->execute();

        // DELETE (table name, condition)
        \Yii::$app->db->createCommand()->delete('article', 'status = 0')->execute();

        \Yii::$app->db->createCommand()->batchInsert('article', ['title', 'click'], [
            ['Tom1', 30],
            ['Jane1', 20],
            ['Linda1', 25],
        ])->execute();


        $sql1 = '';
        $sql2 = '';
        $db = \Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            $db->createCommand($sql1)->execute();
            $db->createCommand($sql2)->execute();
            // ... executing other SQL statements ...

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }


        $rows = (new \yii\db\Query())
            ->select(['id', 'title'])
            ->from('article')
            ->where(['title' => 'test'])
            ->limit(10)
            ->all();
        dump($rows);

    }

    public function actionIndex()
    {
        //echo 'hello word!';

        /*$article = new Article();
        echo '<pre>';
        var_dump($article);
        echo '</pre>';*/

        /*$article = new \app\models\Article();
        $article = \app\models\Article::findOne(1);
        echo '<pre>';
        var_dump($article);
        echo '</pre>';*/

        /*//接值
        $request = \Yii::$app->request;
        $id = $request->get('id');
        var_dump($id);*/


        /*// INSERT（第一个参数是表名，第二个参数是值）
        $res = \Yii::$app->db->createCommand()->insert('article', [
            'title' => '哈哈哈',
            'desc' => '哈哈哈1',
            'content' => '哈哈哈2'
        ])->execute();
        var_dump($res);*/

        /*//删除语句（第一个参数是表名，第二个参数是值）
        $res = \Yii::$app->db->createCommand()->delete('article', "id = 2")->execute();
        var_dump($res);*/

        /*//修改语句（第一个值是表名，第二个值是数组[要修改的值]，第三个值是条件）
        $res = \Yii::$app->db->createCommand()->update('article', ['title'=>'哈哈哈哈333'],["id" => 1])->execute();
        var_dump($res);*/

        /*$command = \Yii::$app->db->createCommand('SELECT * FROM article');
        $res = $command->queryAll();
        var_dump($res);*/

        /*//查询单条
        $command = \Yii::$app->db->createCommand("SELECT * FROM article WHERE id=1");
        $res = $command->queryOne();
        var_dump($res);*/

        /*$showObj = new Query();
        $res = $showObj->select("id,title,desc")->from("article")->all();
        var_dump($res);
        $res = $showObj->select("id,title,desc")->from("article")->where(['id'=>1])->all();
        var_dump($res);*/

    }
}