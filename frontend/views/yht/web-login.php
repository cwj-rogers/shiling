<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<head>
    <title>荟家装云合同登录</title>
</head>
<div class="weui-msg">
    <div class="weui-msg__icon-area">
<!--            <i class="weui-icon-waiting weui-icon_msg"></i>-->
        <img src="http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/%E4%BA%91%E5%90%88%E5%90%8C/%E4%BA%91X%E8%8D%9F.png?t=1534325733315" alt="">
    </div>
    <div class="weui-msg__text-area">
        <h1 class="weui-msg__title" style="color: #0a6aa1">快速登录</h1>
        <p class="weui-msg__desc">请填写在云合同平台实名认证过的用户名和手机号</p>
    </div>
    <div class="weui-msg__opr-area">
        <form action="<?= Url::toRoute(['yht-login/web'])?>" method="post">
            <div class="weui-cells__title">用户名</div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__hd" style="margin-right: 0px">
                        <p>用户名：</p>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="yht_username" type="text" placeholder="某某某 / XXX公司" value="">
                    </div>
                </div>
            </div>

            <div class="weui-cells__title">手机号</div>
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__hd" style="margin-right: 0px">
                        <p>手机号：</p>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="yht_phoneNo" type="text" placeholder="13*********" value="">
                    </div>
                </div>
            </div>

            <div class="weui-cell tmp-submit">
                <input type="submit" class="weui-btn weui-btn_primary">
            </div>
            <div class="weui-cells__tips">请按真实身份仔细认真填写, 冒认他人信息登录平台将进行法律追究</div>

        </form>
    </div>
</div>


