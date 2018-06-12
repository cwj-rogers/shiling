<?php

namespace console\controllers;

class FakeController extends \yii\console\Controller
{
    public function actionIndex()
    {
        $this->stdout('hello world');
//        return $this->render('index');
    }

}
