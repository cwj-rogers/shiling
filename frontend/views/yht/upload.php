<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-download weui-icon_msg" style="transform:rotate(180deg);font-size: 88px"></i></div>
        <form action="<?= Url::toRoute(['yht/upload'])?>" method="post" enctype="multipart/form-data">
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title">上传合同文件</h2>
                <div class="weui-msg__desc" style="padding: 40px 0;padding-top: 20px">
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
                                        <input id="uploaderInput" name="contract" class="weui-uploader__input" type="file" accept="image/*" multiple="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">
<!--                    <a href="--><?//= Url::toRoute(['yht/index'])?><!--" class="weui-btn weui-btn_primary">提交合同</a>-->
                    <input type="submit" class="weui-btn weui-btn_primary" value="提交合同">
                </p>
            </div>
        </form>
    </div>
<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/yht.js"></script>
<script type="text/javascript">
    $(function () {
        $.showLoading("正在载入合同");
        setTimeout(function () {
            $.hideLoading();
        },3500);

        let contractId = <?= "1809101600055872"?>;
        //1. 加载合同详情作背景
        var tokenUnableListener = function (obj){ //当 token 不合法时，SDK 会回调此方法
            $.ajax({
                type:'POST',
                url:<?= json_encode(Url::toRoute("token"))?>,  //第三方服务器获取 token 的 URL，云合同 SDK 无法提供
                cache:false,
                dataType: 'json',
                data:{signerId:"2018062817051800007"},  //第三方获取 token 需要的参数
                beforeSend:function (xhr){
                    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                },
                success: function(data,textStatus,request){
                    YHT.setToken(data.obj);  //重新设置token，从请求头获取 token
                    YHT.do(obj); //调用此方法，会继续执行上次未完成的操作
                },
                error: function (data) {
                    $.alert(data);
                }
            });
        };
        YHT.init("AppID", tokenUnableListener);  //必须初始化 YHT
        //合同查看方法
        YHT.queryContract(
            function successFun(url) {
                location.href = url;
            },
            function failFun(data) {
                $.alert(data);
            },
            contractId
        );
    })
</script>

