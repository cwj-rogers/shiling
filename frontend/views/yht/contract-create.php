<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div id="sectionB">
    <iframe id="contract-box" src="" contract="<?= $contractId?>" frameborder="0" marginheight=0 marginwidth=0 scrolling="auto"></iframe>
<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/m/yht.js"></script>
<script type="text/javascript">
    $(function () {
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
                    // console.log(data);
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
                alert(data);
            },
            contractId
        );

        //微信分享配置
        var detailUrl = <?= json_encode(Url::toRoute(["yht/contract-detail",'contractId'=>$contractId]))?>;
        var lockContractUrl = <?= json_encode(Url::toRoute(["yht/contract-lock",'contractId'=>$contractId]))?>;
        wx.ready (function () {
            var $wx_share = [
                'http://hjzhome.image.alimmdn.com/微信/云合同/splash_1532757769.png?t=1533178660358',
                detailUrl,
                '签订合同',
                '荟家装邀请您进入云合同，点击查看详情'
            ];
            // 微信分享的数据
            var shareData = {
                "imgUrl" : $wx_share[0],    // 分享显示的缩略图地址
                "link" : $wx_share[1],    // 分享地址
                "title" : $wx_share[2],   // 分享标题
                "desc" : $wx_share[3],   // 分享描述
                success : function () {
                    // 分享成功, 锁定空置合同
                    $.getJSON(lockContractUrl,function () {
                        $.alert("合同已成功发送,到微信@朋友吧","分享成功");
                    })
                }
            };
            //只支持发送给朋友
            wx.onMenuShareAppMessage (shareData);
        });
    })
</script>


