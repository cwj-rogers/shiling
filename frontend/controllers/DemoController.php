<?php

namespace frontend\controllers;
use \common\helpers\FuncHelper as output;

class DemoController extends \yii\web\Controller
{
    public $layout = "hjz";
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAbout(){
        return $this->render('about');
    }

    public function actionServer(){
        return $this->render('server');
    }
    public function actionServer2(){
        $this->layout = false;
        return $this->render('server2');
    }

    public function actionPicture(){
        return $this->render('picture');
    }

    public function actionNews(){
        return $this->render('news');
    }

    public function actionCase(){
        return $this->render('case');
    }

    public function actionMessage(){
        return $this->render('message');
    }

    public function actionUidata(){
        $arr = ["config"=>["met_online_type"=>"3", "met_stat"=>"0"]];
        echo json_encode($arr);
    }
}
