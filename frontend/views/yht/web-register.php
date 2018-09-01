<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<script type="text/javascript" charset="utf-8">
    //微信分享配置
    var registerUrl = <?= json_encode(Url::toRoute(["yht-login/register"],true))?>;
    wx.ready (function () {
        var $wx_share = [
            'http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/%E4%BA%91%E5%90%88%E5%90%8C/splash_1532757769.png?t=1533178660358',
            registerUrl,
            '云合同用户注册',
            '荟家装邀请您进入云合同用户注册，点击查看详情'
        ];
        // 微信分享的数据
        var shareData = {
            "imgUrl" : $wx_share[0],    // 分享显示的缩略图地址
            "link" : $wx_share[1],    // 分享地址
            "title" : $wx_share[2],   // 分享标题
            "desc" : $wx_share[3],   // 分享描述
            success : function () {
                // 分享成功, 锁定空置合同
                $.alert("分享成功");
            }
        };
        //只支持发送给朋友
        wx.onMenuShareAppMessage (shareData);
    });
</script>
<header class="cont_header">
    <p>云合同用户注册</p>
</header>
<div id="register">
    <!-- 容器 -->
    <div class="weui-tab">
        <div class="weui-navbar">
            <a class="weui-navbar__item weui-bar__item--on" href="#tab1">
                个人用户
            </a>
            <a class="weui-navbar__item" href="#tab2">
                企业用户
            </a>
        </div>
        <div class="weui-tab__bd">
            <!--  个人用户  -->
            <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
                <form id="personal" name="personal" action="<?= Url::toRoute(['yht-login/register'])?>" method="post">
                    <div class="weui-cells__title">用户姓名</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">姓名:</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="username" type="text" placeholder="请输入用户姓名">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">身份证号码</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">身份证:</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="certifyNum" type="text" placeholder="请输入身份证号码">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">手机号</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">手机:</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="phoneNo" type="number" pattern="[0-9]*" placeholder="请输入手机号">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cell tmp-submit">
<!--                        <input type="submit" class="weui-btn weui-btn_primary">-->
                        <a href="javascript:;" class="submit-info weui-btn weui-btn_primary" form="personal" type="1">提交</a>
                    </div>
                    <div class="weui-cells__tips">请按表单要求仔细认真填写信息, 信息提交后不能再做修改</div>
                </form>
            </div>


            <!--  企业用户  -->
            <div id="tab2" class="weui-tab__bd-item">
                <form id="company" name="company" action="<?= Url::toRoute(['yht-login/register'])?>" method="post">
                    <div class="weui-cells__title">企业名称</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">名称:</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="username" type="text" placeholder="请输入企业名称">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">营业执照</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">营业执照:</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="certifyNum" type="text" placeholder="请输入营业执照注册号">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cells__title">手机号</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd"><label class="weui-label">手机:</label></div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" name="phoneNo" type="number" pattern="[0-9]*" placeholder="请输入手机号">
                            </div>
                        </div>
                    </div>
                    <div class="weui-cell tmp-submit">
<!--                        <input type="submit" class="weui-btn weui-btn_primary">-->
                        <a href="javascript:;" class="submit-info weui-btn weui-btn_primary" form="company" type="2">提交</a>
                    </div>
                    <div class="weui-cells__tips">请按表单要求仔细认真填写信息, 信息提交后不能再做修改</div>
                </form>
            </div>
        </div>
    </div>

    <!--  显示二维码  -->
    <div class="weui-gallery" style="display: none">
        <span class="weui-gallery__img" style="background-image: url(/static/images/wx-register.png);">
            请用微信扫一扫进入云合同注册
        </span>
        <div class="weui-gallery__opr">
            <a href="javascript:" class="weui-gallery__del">
                <img src="/static/images/scan.png" alt="">
            </a>
        </div>
    </div>

</div>
<script>
    $(function () {
        let showQrcode = <?= $showQrcode?>;
        if (showQrcode==1){
            $('.weui-gallery').show();
        }
        // 提交资料注册用户
        $("#register").on('click','.submit-info',function (e) {
            let url = <?= json_encode(Url::toRoute(['yht/create-user']))?>;
            let index_url = <?= json_encode(Url::toRoute(['yht/index']))?>;
            let form = $(this).attr("form");
            let type = $(this).attr("type");
            let items = $('#'+form).serialize()+'&type='+type;
            url = url+'?'+items;
            // console.log(url);
            if (type>0){
                $.getJSON(url,function (data) {
                    console.log(data);
                    if (data.code===200){
                        $.toast("注册成功", function() {
                            location.href = index_url;
                        });
                    }else {
                        $.alert(data.msg);
                    }
                })
            }else{
                $.toast("请选择角色", "cancel");
            }
        });
    })
</script>