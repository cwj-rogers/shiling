<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/0.4.3/weui.min.css">
    <title>跳转提示</title>
    <style type="text/css">
    </style>
</head>
<body>
    <div class="weui_msg">
        <div class="weui_icon_area"><i class="weui_icon_warn weui_icon_msg"></i></div>
        <div class="weui_text_area">
            <h2 class="weui_msg_title">操作失败</h2>
            <p class="weui_msg_desc"><?= $message?></p>
        </div>
        <div class="weui_opr_area">
            <p class="weui_btn_area">
                <a href="<?= $jumpUrl?>" class="weui_btn weui_btn_primary">确定</a>
                <a href="<?= $jumpUrl?>" class="weui_btn weui_btn_default">取消</a>
            </p>
        </div>
        <div class="weui_extra_area">
            <a href="<?= $jumpUrl?>">回到首页</a>
        </div>
    </div>
</body>
</html>
