<?php

namespace backend\controllers;

class YhtController extends \yii\web\Controller
{
    public $layout = 'yhtmain';
    public function actionIndex()
    {
        return $this->render('index');
    }

}
