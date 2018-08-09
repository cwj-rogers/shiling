<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div id="sectionB">
    <iframe id="contract-box" src="" frameborder="0" marginheight=0 marginwidth=0 scrolling="auto"></iframe>

    <!--  权限判断，1.未签约 2.非合同创建者  -->
    <?php if ($status==0 && $isGuest==1):?>
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
                    <img src="" alt="">
                    <button href="javascript:;" class="show-gallery weui-btn weui-btn_mini weui-btn_default">查看大图</button>
                </div>
                <p>检查印章签名并且确认无误，点击下一步立即签约</p>
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
                <img src="" alt="">
            </div>
        </div>
        <div class="weui-gallery__opr">
            <a href="javascript:" class="weui-gallery__del">
                <i class="weui-icon-cancel"></i>
            </a>
        </div>
    </div>

</div>
<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/m/yht.js"></script>
<script type="text/javascript">

    $(function () {
        var type = 0;
        var contractId = <?= $contractId?>;
        var signerId = 0;
        var moulageId = 0;
        var countdownTime = 60;//倒计时60秒

        // $("#signature").removeClass('hide').popup();


        //6.获取短信信息 a.添加签署人+静默签署 b.获取短信 c.验证短信+ 双方签署成功
        $(document).on('click','#signature .verify-sms, .weui-dialog .verify-sms2',function () {
            let urlSendSms = <?= json_encode(Url::toRoute(['yht/verify','contractId'=>$contractId]))?>;
            let urlContractSign = <?= json_encode(Url::toRoute(['yht/contract-sign','contractId'=>$contractId]))?>;
            let utlVerifySuccess = <?= json_encode(Url::toRoute(['yht/verify-success','contractId'=>$contractId]))?>;
            let urlVerifyCheck = <?= json_encode(Url::toRoute(['yht/verify-check','contractId'=>$contractId]))?>;
            let objName = $(this).hasClass("verify-sms");
            if (countdownTime===60){
                //添加签署人+静默签署
                $.showLoading('正在添加签署人');
                $.getJSON(urlContractSign,function (data) {
                    if (data.code===200){
                        $.hideLoading();
                        //是否进行短信验证
                        if (data.obj.verifyPhone===1){
                            //发送短信验证码,区分首次获取+再次获取
                            $.showLoading('正在发送验证码');
                            $.getJSON(urlSendSms,function (data) {
                                if (data.code===200){
                                    $.hideLoading();
                                    $.toast("短信已发送！", "success",function () {
                                        //短信验证码输入窗口
                                        objName && $.verifyPrompt(data);
                                        //开启计时插件
                                        countDown(".weui-dialog .count-down",countdownTime);
                                    });
                                }else {
                                    $.hideLoading();
                                    $.toast(data.msg,'cancel');
                                }
                            });
                        }else{
                            //不要手机短信验证
                            $.hideLoading();
                            $.showLoading('用户信息验证');
                            $.getJSON(urlVerifyCheck,function (data) {
                                if (data.code===200){
                                    $.hideLoading();
                                    $.toast("验证成功",function () {
                                        location.href = utlVerifySuccess;
                                    });
                                } else {
                                    $.hideLoading();
                                    $.toast(data.msg,'forbidden');
                                }
                            });
                        }
                    } else{
                        $.hideLoading();
                        $.alert(data.msg);
                    }
                });
            } else {
                $.toast('稍等,请在'+countdownTime+'秒后重新获取','text');
            }
        });
        // $.verifyPrompt({'obj':{'phoneNo':10086}});
        // countDown(".weui-dialog .count-down");
        //6.1 获取短信+短信验证
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
        // 活动结束计时器
        function countDown(className) {
            let cdInterval = setInterval(function () {
                if(countdownTime>0){
                    console.log(countdownTime);
                    $(className).html(countdownTime + "秒后").parent().addClass("weui-btn_disabled");
                    countdownTime--;
                }else{
                    $(className).html("点击").parent().removeClass("weui-btn_disabled");
                    clearInterval(cdInterval);//过期清除定时器
                    countdownTime = 60;
                }
            }, 1000);
        }


        //5. 签名页 查看专属印模
        function signatrueInit(moulageId) {
            let urlGetMoulage = <?= json_encode(Url::toRoute(['yht/get-moulage']))?> +'?moulageId='+moulageId+'&contractId='+contractId;
            $.getJSON(urlGetMoulage,function (data) {
                if (data.code===200){
                    let base64 = "data:image/png;base64,"+data.obj;
                    $("#signature .image img").attr("src", base64);
                    $("#signature").removeClass('hide').popup();
                }else{
                    $.alert(data.msg);
                }
            });
        }
        //5.1 放大专属印模
        $('#signature').on('click','.image',function (e) {
            let base64 = $(this).find("img").attr('src');
            $('.weui-gallery img').attr("src",base64);
            $('.weui-gallery').fadeIn();
        });
        $('.weui-gallery').on('click','.weui-gallery__del',function (e) {
            $('.weui-gallery').fadeOut();
        });


        // 4.提交资料注册用户
        $("#sectionB").on('click','.submit-info',function (e) {
            var url = <?= json_encode(Url::toRoute(['yht/create-user']))?>;
            var form = $(this).attr("form");
            var items = $('.'+form).serialize()+'&type='+type;
            url = url+'?'+items;
            console.log(url);
            if (type>0){
                $.getJSON(url,function (data) {
                    console.log(data);
                    if (data.code===200){
                        signerId = data.obj.signerId;
                        moulageId = data.obj.moulageId;
                        $.alert('<i class="weui-icon-success weui-icon_msg"></i>', "认证成功,领取专属印章", function() {
                            //点击确认,1.获取印模base64 2.打开签名页
                            // $("#signature").removeClass('hide').popup();
                            signatrueInit(moulageId);
                        });
                    }else {
                        $.alert(data.msg);
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
            $.showLoading('正在获取用户信息');
            let urlSign = <?= json_encode(Url::toRoute(['yht/sign']))?>;
           $.getJSON(urlSign,function (data) {
               $.hideLoading();
                if (data.code===200){
                    signatrueInit(data.obj.moulageId);
                }else{
                    //进入注册流程
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
        //1.1 合同查看方法
        YHT.queryContract(
            function successFun(url) {
                var windowH = window.innerHeight - 80;
                $("#contract-box").css('height',windowH+'px');
                $("#contract-box").attr('src',url);
            },
            function failFun(data) {
                alert(data);
            },
            contractId
        );
    })
</script>


