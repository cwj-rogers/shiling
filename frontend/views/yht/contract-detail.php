<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div id="sectionB">
    <iframe id="contract-box" src=""></iframe>
    <!--  权限判断，1.未签约 2.普通用户  -->

    <div class="sign hide">
        <a href="" class="weui-flex">
            <div class="weui-flex__item">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-bi"></use>
                </svg>
            </div>
            <div class="weui-flex__item">进入签约</div>
        </a>
    </div>
    <!--  选择角色  -->
    <div id="register hide" class="weui-popup__container popup-bottom register-step">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <div class="top">合同需要有效信息认证，请选择认证角色</div>
            <div class="bottom">
                <div class="user">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-geren"></use>
                    </svg>
                    <span>个人用户</span>
                </div>
                <div class="company">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-qiye1"></use>
                    </svg>
                    <span>企业用户</span>
                </div>
            </div>
        </div>
    </div>
    <!--  个人用户  -->
    <div id="personal hide" class="weui-popup__container popup-bottom register-step">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <div class="top">个人用户</div>
            <hr>
            <div class="bottom">
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">用户姓名:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" placeholder="请输入用户姓名">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">身份证号码:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" placeholder="请输入身份证号码">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">手机号:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入手机号">
                        </div>
                    </div>
                </div>
                <a href="javascript:;" class="weui-btn weui-btn_default">提交</a>
            </div>
        </div>
    </div>
    <!--  企业用户  -->
    <div id="company" class="weui-popup__container popup-bottom register-step">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <div class="top">企业用户</div>
            <hr>
            <div class="bottom">
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">企业名称:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" placeholder="请输入企业名称">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">营业执照:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" placeholder="请输入营业执照注册号">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">手机号:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入手机号">
                        </div>
                    </div>
                </div>
                <a href="javascript:;" class="weui-btn weui-btn_default">提交</a>
            </div>
        </div>
    </div>
    <!--  签名页  -->
    <div id="signature" class="weui-popup__container popup-bottom register-step">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <iframe id="signature-box" src="https://api.yunhetong.com/api_page/app/drag_sing.html?&token=Bybw9SYqJh8z4xUzHh8V4-cz3OMVMzMzM-cmICbxEyYq49zZH-fnJDMe3Nzc5wQ=&dragSign=1"></iframe>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/m/yht.js"></script>
<script type="text/javascript">
    $(function () {
        $("#signature").popup();


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
                    alert(data);
                }
            });
        };
        YHT.init("AppID", tokenUnableListener);  //必须初始化 YHT
        tokenUnableListener();
        $.ajax({
            type:'POST',
            async:false,  //请使用同步
            url:<?= json_encode(Url::toRoute("contract"))?>,  //第三方服务器获取合同 ID 的 URL
            cache:false,
            dataType:'json',
            success: function(data, textStatus, jqXHR){
                var contractId=data.obj;
                //合同查看方法
                YHT.queryContract(
                    function successFun(url) {
                        // console.log(url);
                        window.open(url);
                        // location.href = url;
                        var windowH = window.innerHeight;
                        $("#contract-box").css('height',windowH+'px');
                        $("#contract-box").attr('src',url);
                    },
                    function failFun(data) {
                        alert(data);
                    },
                    contractId
                );
                //合同签署页面
                // YHT.signContract(
                //     function successFun(url) {
                //         window.open(url);
                //         // var windowH = window.innerHeight;
                //         // $("#contract-box").css('height',windowH+'px');
                //         $("#contract-box").attr('src',url);
                //     },
                //     function failFun(data) {
                //         console.log(data);
                //     },
                //     contractId
                // );
                //前置绘制签名页面
                YHT.dragSignF(
                    function successFun(url) {
                        // window.open(url);
                        // console.log(url);
                        // location.href = url;
                        // $("#signature-box").attr('src',url);
                    },
                    function failFun(data) {
                        console.log(data);
                    }
                );
            },
            error: function (data) {
            }
        });

        //微信分享配置
        var localUrl = location.href;
        var lockContractUrl = <?= json_encode(Url::toRoute(["yht/contract"]))?>;
        wx.ready (function () {
            var $wx_share = [
                'http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/9.9small.png',
                localUrl,
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
                        alert(分享成功)
                    })
                }
            };
            wx.onMenuShareAppMessage (shareData);
        });
    })
</script>


