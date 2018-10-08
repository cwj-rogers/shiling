<?php

namespace frontend\controllers;
use \common\helpers\FuncHelper as output;
use Yii;

class DemoController extends \yii\web\Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index2');
    }

    public function actionAbout(){
        return $this->render('about2');
    }

    public function actionServer(){
        return $this->render('server2');
    }

    public function actionPicture(){
        return $this->render('picture2');
    }

    public function actionNews(){
        return $this->render('news2');
    }

    public function actionCase(){
        if (Yii::$app->request->isAjax){
            $file = Yii::$app->basePath."/views/demo/case2.php";
            $content = file_get_contents($file);
            $pregRule = "/<ul[^>]*class=\"blocks-2 blocks-sm-3 blocks-md-4 blocks-xlg-4  met-page-ajax\"[^>]*>(.*?) <\/ul>/si";
            preg_match($pregRule,$content,$matches);
            //p($matches[1],1);
            echo trim($matches[1]);die;
        }
        return $this->render('case2');
    }

    public function actionMessage(){
        return $this->render('message2');
    }

    /**
     * 前台获取配置
     */
    public function actionUidata(){
        $arr = ["config"=>["met_online_type"=>"3", "met_stat"=>"0"]];
        echo json_encode($arr);
    }
    public function actionFile($name){
        if ($name=="bgmp3_cn"){
            $path = Yii::$app->basePath."/web/static/demo/audio_templatesM1156010minmusicbgmp3_cn.txt";
            $content = file_get_contents($path);
            echo $content;die;
        }elseif (1){

        }
    }
}
