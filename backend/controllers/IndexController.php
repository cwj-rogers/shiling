<?php

namespace backend\controllers;

use Yii;

/**
 * 后台首页控制器
 * @author longfei <phphome@qq.com>
 */
class IndexController extends BaseController
{
    public function actionIndex()
    {
        p(json_decode('{"province":["\u7701\u4e0d\u80fd\u4e3a\u7a7a\u3002"],"city":["\u57ce\u5e02\u4e0d\u80fd\u4e3a\u7a7a\u3002"]}',true),1);
        return $this->render('index');
    }

}
