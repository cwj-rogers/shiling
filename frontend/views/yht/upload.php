<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-download weui-icon_msg" style="transform:rotate(180deg);font-size: 88px"></i></div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">上传合同文件</h2>
            <div class="weui-msg__desc" style="padding: 50px 0;padding-top: 20px">
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <div class="weui-uploader">
                                <div class="weui-uploader__hd">
                                    <p class="weui-uploader__title">*必须为word文档格式</p>
<!--                                    <div class="weui-uploader__info">0/2</div>-->
                                </div>
                            </div>
                            <div class="weui-uploader__bd">
                                <div class="weui-uploader__input-box" style="margin: 20px auto;float: none;">
                                    <input id="uploaderInput" class="weui-uploader__input" type="file" accept="image/*" multiple="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a href="<?= Url::toRoute(['yht/index'])?>" class="weui-btn weui-btn_primary">提交合同</a>
            </p>
        </div>
    </div>


