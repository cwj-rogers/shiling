<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=yes" />

<div id="contract-demo">
    <iframe id="contract-box" src="" contract="<?= $contractId?>" frameborder="0" marginheight=0 marginwidth=0 scrolling="auto" style="width: 100%"></iframe>
    <div class="go-back"><a href="javascript: history.back(-1);" class="weui-btn weui-btn_primary">返回</a></div>
</div>

<!-- 根据不同的客户端访问加载不同JS -->
<?php if (!Yii::$app->wechat->isWechat):?>
    <script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/yht.js"></script>
<?php else:?>
    <script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/m/yht.js"></script>
<?php endif;?>
<script type="text/javascript">
    $(function () {
        $.showLoading("正在载入合同");
        setTimeout(function () {
            $.hideLoading();
        },3500);

        let isWechat = <?= json_encode(Yii::$app->wechat->isWechat)?>;
        if(!isWechat){
            //PC 端全屏查看
            $("#container").css('max-width','100%');
        }

        let contractId = <?= $contractId?>;
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
                var windowH = window.innerHeight - 70;
                $("#contract-box").css('height',windowH+'px');
                $("#contract-box").attr('src',url);
            },
            function failFun(data) {
                $.alert(data);
            },
            contractId
        );
    })
</script>


