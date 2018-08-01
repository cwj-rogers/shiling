<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div id="sectionB">
    <iframe id="contract-box" src=""></iframe>

    <!--  权限判断，1.未签约 2.普通用户  -->
    <?php if ($status!=1 && $isGuest==1):?>
    <div class="sign">
        <a href="javascript:;" class="weui-flex">
            <div class="weui-flex__item">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-bi"></use>
                </svg>
            </div>
            <div class="weui-flex__item">进入签约</div>
        </a>
    </div>
    <?php endif;?>
    <!--  选择角色  -->
    <div id="register" class="hide weui-popup__container popup-bottom register-step">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <div class="top">合同需要有效信息认证，请选择认证角色</div>
            <div class="bottom">
                <div class="user reg-type" type="1">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-geren"></use>
                    </svg>
                    <span>个人用户</span>
                </div>
                <div class="company reg-type" type="2">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-qiye1"></use>
                    </svg>
                    <span>企业用户</span>
                </div>
            </div>
        </div>
    </div>
    <!--  个人用户  -->
    <div id="personal" class="hide weui-popup__container popup-bottom register-step">
        <div class="weui-popup__overlay"></div>
        <form action="" class="form-personal">
        <div class="weui-popup__modal">
            <div class="top">个人用户</div>
            <hr>
            <div class="bottom">
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">用户姓名:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="username" type="text" placeholder="请输入用户姓名">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">身份证号码:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="certifyNum" type="text" placeholder="请输入身份证号码">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">手机号:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="phoneNo" type="number" pattern="[0-9]*" placeholder="请输入手机号">
                        </div>
                    </div>
                </div>
                <a href="javascript:;" class="submit-info weui-btn weui-btn_default" form="form-personal">提交</a>
            </div>
        </div>
        </form>
    </div>
    <!--  企业用户  -->
    <div id="company" class="hide weui-popup__container popup-bottom register-step">
        <div class="weui-popup__overlay"></div>
        <form action="" class="form-company">
        <div class="weui-popup__modal">
            <div class="top">企业用户</div>
            <hr>
            <div class="bottom">
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">企业名称:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="username" type="text" placeholder="请输入企业名称">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">营业执照:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="certifyNum" type="text" placeholder="请输入营业执照注册号">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">手机号:</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" name="phoneNo" type="number" pattern="[0-9]*" placeholder="请输入手机号">
                        </div>
                    </div>
                </div>
                <a href="javascript:;" class="submit-info weui-btn weui-btn_default" form="form-company">提交</a>
            </div>
        </div>
        </form>
    </div>
    <!--  显示签名页  -->
    <div id="signature" class="hide weui-popup__container popup-bottom register-step">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <div class="head">
                <p>专属签名印章</p>
            </div>
            <hr>
            <div class="body">
                <div class="image">
                    <img src="data:image/png;base64,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" alt="">
                    <button href="javascript:;" class="show-gallery weui-btn weui-btn_mini weui-btn_default">查看大图</button>
                </div>
                <p>检查印章签名并且确认无误，然后点击下一步</p>
                <div class="go-verify">
                    <button href="javascript:;" class="verify-sms weui-btn weui-btn_default">下一步,短信验证</button>
                </div>
            </div>
        </div>
    </div>
    <!--  印模放大到画框  -->
    <div class="weui-gallery" style="display: none">
        <div class="weui-gallery__img">
            <div class="frame">
                <img src="data:image/png;base64,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" alt="">
            </div>
        </div>
        <div class="weui-gallery__opr">
            <a href="javascript:" class="weui-gallery__del">
<!--                <i class="weui-icon-delete weui-icon_gallery-delete"></i>-->
                <i class="weui-icon-cancel"></i>
            </a>
        </div>
    </div>

</div>
<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/m/yht.js"></script>
<script type="text/javascript">
    var type = 0;
    var contractId = 0;
    var signerId = 0;
    var moulageId = 0;
    var countdownTime = 60;//倒计时60秒
    $(function () {
        $("#signature").removeClass('hide').popup();

        //6.获取短信信息 a.获取短信 b.验证短信
        $(document).on('click','#signature .verify-sms, .weui-dialog .verify-sms2',function () {
            let urlSendSms = <?= json_encode(Url::toRoute(['yht/verify','contractId'=>$contractId]))?>;
            let objName = $(this).hasClass("verify-sms");
            if (countdownTime===60){
                //发送短信验证码
                $.getJSON(urlSendSms,function (data) {
                    if (data.code===200){
                        $.toast("短信已发送！", "success",function () {
                            //短信验证码输入窗口
                            objName && $.verifyPrompt(data);
                            //开启计时插件
                            countDown(".weui-dialog .count-down",countdownTime);
                        });
                    }else {
                        $.toast(data.msg,'cancel');
                    }
                });
            } else {
                $.toast('稍等,请在'+countdownTime+'秒后重新获取','text');
            }
        });
        $.verifyPrompt = (data,error='')=>{
            let urlVerify = <?= json_encode(Url::toRoute(['yht/verify-check','contractId'=>$contractId]))?>;
            let utlVerifySuccess = <?= json_encode(Url::toRoute(['yht/verify-success','contractId'=>$contractId]))?>;
            $.prompt({
                title: '签署码已发送至'+data.obj.phoneNo,
                text: '<a href="javascript:;" class="weui-btn weui-btn_plain-default verify-sms2"> <span class="count-down">秒后</span>重新获取</a><p class="weui-cell_warn">'+error+'</p>',
                input: '',
                empty: false, // 是否允许为空
                onOK: function (input) {
                    // console.log(input);
                    //验证码前端判断
                    if(!(/^\d+$/.test(input))){
                        $.verifyPrompt(data,'验证码必须为数字');
                        countdownTime===60 && $('.weui-dialog .count-down').text('点击');
                        return false;
                    }else if(input.length!=4){
                        $.verifyPrompt(data,'验证码必须为4位数字');
                        countdownTime===60 && $('.weui-dialog .count-down').text('点击');
                        return false;
                    }
                    urlVerify = urlVerify + '&code=' + input;
                    $.getJSON(urlVerify,function (data) {
                        if (data.code==200){
                            $.toast("验证成功",function () {
                                location.href = utlVerifySuccess;
                            });
                        } else {
                            $.toast(data.msg,'forbidden');
                        }
                    })
                },
                onCancel: function () {
                    $.toast("请重新获取验证码",'forbidden');

                }
            });
        };
        // $.verifyPrompt({'obj':{'phoneNo':10086}});
        // countDown(".weui-dialog .count-down");
        // 活动结束计时器
        function countDown(className) {
            let cdInterval = setInterval(function () {
                if(countdownTime>0){
                    console.log(countdownTime);
                    $(className).html(countdownTime + "秒后").parent().addClass("weui-btn_disabled");
                    countdownTime--;
                }else{
                    $(className).html("点击").parent().removeClass("weui-btn_disabled");
                    clearInterval(cdInterval);//过期清楚定时器
                    countdownTime = 60;
                }
            }, 1000);
        }

        //5. 查看专属印章
        $('.weui-gallery').on('click','.weui-gallery__del',function (e) {
            $('.weui-gallery').fadeOut();
        });
        $('#signature').on('click','.image',function (e) {
            $('.weui-gallery').fadeIn();
        });

        // 4.提交资料注册用户
        $("#sectionB").on('click','.submit-info',function (e) {
            // var items = $(this).parentsUntil('.form-info').serializeArray();
            var url = <?= json_encode(Url::toRoute(['yht/create-user']))?>;
            var form = $(this).attr("form");
            var items = $('.'+form).serialize()+'&type='+type;
            url = url+'?'+items;
            console.log(url);
            if (type>0){
                $.getJSON(url,function (data) {
                    console.log(data);
                    // var res = JSON.parse(data);console.log(res);
                    if (data.code=200){
                        signerId = data.obj.signerId;
                        moulageId = data.obj.moulageId;
                        $.alert('<i class="weui-icon-success weui-icon_msg"></i>', "认证成功,领取专属印章", function() {
                            //点击确认后的回调函数
                            $("#signature").removeClass('hide').popup();
                        });
                    }else {
                        $.toast(data.msg,'cancel');
                    }
                })
            }else{
                $.toast("请返回选择角色", "cancel");
        }
        });

        //3.选择实名认证的角色
        $("#sectionB").on('click','.reg-type',function () {
            type = $(this).attr('type');
            if(type == 1){
                $("#personal").removeClass('hide').popup();
            }else{
                $("#company").removeClass('hide').popup();
            }
        });

        //2.进入签约 判断是否云合同用户 是,跳到签名页 否,进入注册流程
        $('#sectionB').on('click','.sign',function () {
            var urlSign = <?= json_encode(Url::toRoute(['yht/sign']))?>;
           $.getJSON(urlSign,function (data) {
                if (data.code==200){
                    $("#signature").removeClass('hide').popup();
                }else{
                    $.toast(data.msg,'cancel',function () {
                        $("#register").removeClass('hide').popup();
                    });
                }
           })
        });

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
                    alert(data);
                }
            });
        };
        YHT.init("AppID", tokenUnableListener);  //必须初始化 YHT
        function contract(){
            $.ajax({
                type:'POST',
                async:false,  //请使用同步
                url:<?= json_encode(Url::toRoute("contract"))?>,  //第三方服务器获取合同 ID 的 URL
                cache:false,
                dataType:'json',
                success: function(data, textStatus, jqXHR){
                    var contractId=data.obj;
                    $("#sectionB").attr('contractId',contractId);
                    //合同查看方法
                    YHT.queryContract(
                        function successFun(url) {
                            // console.log(url);
                            // window.open(url);
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
                    // YHT.dragSignF(
                    //     function successFun(url) {
                    //         // window.open(url);
                    //         // console.log(url);
                    //         // location.href = url;
                    //         // $("#signature-box").attr('src',url);
                    //     },
                    //     function failFun(data) {
                    //         console.log(data);
                    //     }
                    // );
                },
                error: function (data) {
                }
            });
        }
        // contract();
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


