<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div class="weui-msg">
    <div class="weui-msg__icon-area"><i class="weui-icon-download weui-icon_msg" style="color: #4280FF"></i></div>
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title">请在电脑浏览器输入以下地址</h2>
        <p class="weui-msg__desc" style="word-wrap:break-word;font-size: 38px;color: #4280FF"></p>
    </div>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <a href="javascript:history.back(-1);" class="weui-btn weui-btn_default" style="background-color: #4280FF;color: white">返回</a>
        </p>
    </div>
</div>
<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/yht.js"></script>
<script type="text/javascript">
    $(function () {
        let contractId = <?= $contractId?>;
        //1. 加载合同详情作背景
        var tokenUnableListener = function (obj){ //当 token 不合法时，SDK 会回调此方法
            $.ajax({
                type:'POST',
                url:<?= json_encode(Url::toRoute("/yht/token"))?>,  //第三方服务器获取 token 的 URL，云合同 SDK 无法提供
                cache:false,
                dataType: 'json',
                data:{},  //第三方获取 token 需要的参数
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
                $.showLoading();
                $.getJSON('down-url',{url:url},function (data) {
                    console.log(data);
                    $.hideLoading();
                    if (data.code==200) {
                        $.toast("获取合同下载地址",3000,function () {
                            $(".weui-msg__desc").text(data.obj.short_url);
                        })
                    }else{
                        $.toast("下载地址获取失败")
                    }
                })
            },
            function failFun(data) {
                $.alert(data);
            },
            contractId
        );
    })
</script>


