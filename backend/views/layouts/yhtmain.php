<?php

/** @var $this \yii\web\View */
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\ZanuiAsset;

ZanuiAsset::register($this);// 注册前端资源
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>云合同管理平台</title>
        <link rel="shortcut icon" href="favicon.ico">
        <?php $this->head();?>
        <?php $this->registerJsFile("@web/static/js/jquery.min.js?v=2.1.4",['position'=>View::POS_HEAD])?>
    </head>
    <!-- END HEAD -->

    <body class="gray-bg top-navigation">
        <?php $this->beginBody() ?>
            <!-- BEGIN CONTAINER 正文内容 -->
            <div class="page-container">
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <div class="row">
                            <div class="col-md-12">
                                <?=$content?>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>