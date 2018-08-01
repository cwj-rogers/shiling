<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div id="sectionA">
    <header>
        <p>云合同签署平台</p>
    </header>
    <div class="weui-grids">
        <a href="<?= Url::toRoute(["yht/contract-detail","tid"=>"TEM1003301"])?>" class="weui-grid js_grid">
            <div class="weui-grid-icon">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-qianhetong"></use>
                </svg>
            </div>
            <p class="weui-grid__label">
                地区门店加盟合同
            </p>
        </a>
        <a href="<?= Url::toRoute(["yht/contract-detail","tid"=>"TEM1003301"])?>" class="weui-grid js_grid">
            <div class="weui-grid-icon">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-qianhetong"></use>
                </svg>
            </div>
            <p class="weui-grid__label">
                创客模式加盟合同
            </p>
        </a>
        <a href="<?= Url::toRoute(["yht/contract-detail","tid"=>"TEM1003301"])?>" class="weui-grid js_grid">
            <div class="weui-grid-icon">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-qianhetong"></use>
                </svg>
            </div>
            <p class="weui-grid__label">
                供应商供给合同
            </p>
        </a>

    </div>
</div>
<!--<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/yht.js"></script>-->
<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/m/yht.js"></script>
<script type="text/javascript">
    $(function () {
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
                    console.log(data);
                    YHT.setToken(data.obj);  //重新设置token，从请求头获取 token
                    YHT.do(obj); //调用此方法，会继续执行上次未完成的操作
                },
                error: function (data) {
                    alert(data);
                }
            });
        };
        YHT.init("AppID", tokenUnableListener);  //必须初始化 YHT

        $.ajax({
            type:'POST',
            async:false,  //请使用同步
            url:<?= json_encode(Url::toRoute("contract"))?>,  //第三方服务器获取合同 ID 的 URL
            cache:false,
            dataType:'json',
            data:{},
            success: function(data, textStatus, jqXHR){
                var contractId=data.obj;
                //合同查看方法
                // YHT.queryContract(
                //     function successFun(url) {
                //         console.log(url);
                //         // window.open(url);
                //         // location.href = url;
                //     },
                //     function failFun(data) {
                //         alert(data);
                //     },
                //     contractId
                // );
                //合同签署页面
                // YHT.signContract(
                //     function successFun(url) {
                //         // window.open(url);
                //         console.log(url);
                //         // location.href = url;
                //     },
                //     function failFun(data) {
                //         console.log(data);
                //     },
                //     contractId
                // );
                //前置绘制签名页面
                // YHT.dragSignF(
                //     function successFun(url) {
                //         // window.open(url);
                //         console.log(url);
                //         location.href = url;
                //     },
                //     function failFun(data) {
                //         console.log(data);
                //     }
                // );
            },
            error: function (data) {
            }
        });
    })
</script>


