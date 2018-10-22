<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use common\modelsgii\Region;
use kartik\depdrop\DepDropAction;

/**
 * 公共调用处理
 * @author longfei <phphome@qq.com>
 */
class PublicController extends \common\core\Controller
{

    /** @var bool */
    public $layout = false;

    /** @var bool */
    public $enableCsrfValidation = false;

    /**
     * ---------------------------------------
     * @inheritdoc
     * ---------------------------------------
     */
    public function actionsInits()
    {
        return ArrayHelper::merge(parent::actions(), [
            /* 省市区联动 */
            'region' => [
                'class' => DepDropAction::className(),
                'outputCallback' => function ($id, $params) {
                    $region = Region::find()->where(['parent_code' => $id])->orderBy('code ASC')->asArray()->all();
                    $_out = [];//var_dump($region);
                    foreach ($region as $value) {
                        $_tmp['id'] = $value['code'];
                        $_tmp['name'] = $value['fullname'];
                        $_out[] = $_tmp;
                    }
                    return $_out;
                },
                'selectedCallback' => function ($id, $params) {
                    return Yii::$app->getRequest()->get('sid');
                }
            ],
            /* ueditor文件上传 */
            'ueditor' => [
                'class' => 'common\actions\UEditorAction',
                'config' => Yii::$app->params['ueditorConfig'],
            ],
            /* 单图、多图上传 */
            'uploadimage' => [
                'class' => 'common\widgets\images\UploadAction',
            ],
            /* migration备份数据 */
            'backup' => [
                'class' => 'e282486518\migration\WebAction',
                'returnFormat' => 'json',
                'migrationPath' => '@console/migrations'
            ]
        ]);
    }

    /**
     * ---------------------------------------
     * 通用的404错误处理
     * @return string
     * ---------------------------------------
     */
    public function actionError()
    {
        //渲染模板
//        return $this->render('error');

        $error = Yii::$app->errorHandler->exception;
        //记录错误信息到文件和数据库内
        $file = $error->getFile();
        $line = $error->getLine();
        $message = $error->getMessage();
        $code = $error->getCode();
        //设置错误信息放置格式
        $err_msg = $message. " [file:{$file}][line:{$line}][code:{$code}][url:{$_SERVER['REQUEST_URI']}][POST_DATE:".http_build_query($_POST)."]";
        //页面展示错误信息
        return "错误页面,错误信息:</br></br> {$err_msg}";
    }

}
