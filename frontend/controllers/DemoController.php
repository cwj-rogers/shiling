<?php

namespace frontend\controllers;

class DemoController extends \yii\web\Controller
{
    public $layout = false;
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
}
