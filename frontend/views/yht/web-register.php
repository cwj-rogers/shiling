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
    <p>签约负责人注册</p>
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
                    <div class="weui-cells__tips">请按要求仔细认真填写信息, 信息提交后不能再做修改</div>
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
                    <div class="weui-cells__tips">请按要求仔细认真填写信息, 信息提交后不能再做修改</div>
                </form>
            </div>
        </div>
        <div class="weui-cells__tips" style="color: #da3f3f">* 注册成功后到“荟家装公众号”云合同平台创建合同，账号授权会有延迟，如有疑问可联系荟家装客服</div>
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

    <!--  电子合同条款  -->
    <div id="explain" class="weui-popup__container">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <h3>电子合同的法律地位</h3>
            <p class="text-item">电子合同又称电子商务合同，根据联合国国际贸易法委员会《电子商务示范法》以及世界各国颁布的电子交易法，同时结合我国《合同法》的有关规定，电子合同可以界定为：电子合同是双方或多方当事人之间通过电子信息网络以电子的形式达成的设立、变更、终止财产性民事权利义务关系的协议。</p>
            <p class="text-item">关于电子合同这种合同形式的法律效力，我国立法上已经予以确认：我国《合同法》第十一条规定“书面形式是指合同书、信件和数据电文（包括电报、电传、传真、电子数据交换和电子邮件）等可以有形地表现所载内容的形式。”由此可见，法律已经明确了电子合同的有效性。</p>

            <h3>电子合同的法律效力</h3>
            <p style="color: #0b94ea">《电子签名法》第二条对电子签名的定义：数据电文中以电子形式所含、所附用于识别签名人身份并表明签名人认可其中内容的数据。</p>
            <p>《电子签名法》第三条规定</p>
            <p class="text-item">当事人约定使用电子签名、数据电文的文书，不得仅因为其采用电子签名、数据电文的形式而否定其法律效力。可见电子签名本身已被法律所认可。</p>
            <p>《电子签名法》第十四条规定</p>
            <p class="text-item">可靠的电子签名与手写签名或者盖章具有同等的法律效力。只有使用“可靠的电子签名”，电子合同才有可能具有与纸质合同同等的法律效力，即书证效力。</p>

            <h3>可靠电子签名的法定条件</h3>
            <p style="color: #0b94ea">《电子签名法》第十三条电子签名同时符合下列条件的，视为可靠的电子签名；</p>
            <ul>
                <li>1.电子签名制作数据用于电子签名时，属于电子签名人专有；</li>
                <li>2.签署时电子签名制作数据仅有电子签名人控制；</li>
                <li>3.签署后对电子签名的任何改动能够被发现；</li>
                <li>4.签署后对数据电文内容和形式的任何改动能够被发现。</li>
            </ul>
            <p style="color: #da3f3f">* 当事人通过云合同生成的手写签名完全符合可靠电子签名的法定条件，属于可靠的电子签名。</p>

            <h3>有效电子合同的成立条件</h3>
            <p style="color: #0b94ea">条件一：满足《民法通则》第55条关于合同有效要件的规定：</p>
            <p class="text-item">行为人具有相应的民事行为能力；意思表示真实；不违反法律或者社会公共利益。</p>
            <p style="color: #0b94ea">条件二：满足《中华人民共和国电子签名法》关于有效电子签名的规定：</p>
            <p class="text-item">该法第十四条规定：“可靠的电子签名与手写签名或者盖章具有同等的法律效力。”</p>
            <p style="color: #da3f3f">在第三方签约平台签署的合同，只要满足以上两个条件，即可视为有效的电子合同。</p>

            <h3>诉讼依据</h3>
            <div class="left">
                <p style="color: #0b94ea">1、2012年《民事诉讼法》修改后，第六十三条规定，民事证据包括：</p>
                <ul>
                    <li>（一）当事人的陈述；</li>
                    <li>（二）书证；</li>
                    <li>（三）物证；</li>
                    <li>（四）视听资料；</li>
                    <li>（五）电子数据；</li>
                    <li>（六）证人证言；</li>
                    <li>（七）鉴定意见；</li>
                    <li>（八）勘验笔录。</li>
                </ul>
                <p style="color: #da3f3f">电子数据已经成为独立的证据类型。</p>
            </div>
            <div class="right">
                <p style="color: #0b94ea">2、最高人民法院2015年2月4日公布</p>
                <p class="text-item">《最高人民法院关于适用〈中华人民共和国民事诉讼法〉的解释》网上聊天记录、博客、微博客、手机短信、 电子签名、域名等形成或者存储在电子介质中的信息可以作为民事诉讼中的证据。</p>
                <p style="color: #0b94ea">3、《电子签名法》第六条：符合下列条件的数据电文，视为满足法律、法规规定的文件保存要求，可以作为电子证据使用</p>
                <ul>
                    <li>（一）能够有效地表现所载内容并可供随时调取查用；</li>
                    <li>（二）数据电文的格式与其生成、发送或者接收时的格式相同，或者格式不相同但是能够准确表现原来生成、发送或者接收的内容；</li>
                    <li>（三）能够识别数据电文的发件人、收件人以及发送、接收的时间。</li>
                </ul>
            </div>
            <!-- 复选 -->
            <div class="weui-cells weui-cells_checkbox">
                <label class="weui-cell weui-check__label" for="s11">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" name="checkbox" id="s11" >
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd">
                        <span>荟家装云合同条款阅读完毕并同意上述条款</span>
                    </div>
                </label>
                <div class="weui-cell">
                    <a href="javascript:;" class="close-popup weui-btn weui-btn_primary">确定无误</a>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(function () {
        let showQrcode = <?= $showQrcode?>;
        if (showQrcode==1){
            $('.weui-gallery').show();
        }
        // 电子合同条款
        let explainStatus = 0;
        $(".weui-cell__hd").click(function () {
           let status = $("input[type='checkbox']").prop('checked');
           console.log(status);
           if (status==false){
               explainStatus = 0;
           } else{
               explainStatus = 1;
           }
        });
        //$("#explain").popup();

        // 提交资料注册用户
        $("#register").on('click','.submit-info',function (e) {
            //是否已经同意云合同条款
            if (explainStatus==0){
                $.toast("注册前请仔细阅读云合同条款","text",function () {
                    $("#explain").popup();
                });
                return false;
            }

            let url = <?= json_encode(Url::toRoute(['yht/create-user']))?>;
            let index_url = <?= json_encode(Url::toRoute(['yht/index']))?>;
            let form = $(this).attr("form");
            let type = $(this).attr("type");
            //注册前端判断
            if(!$("input[name=username]").val().length){
                $.alert("姓名/名称 不能为空");
                return false;
            }
            if(!$("input[name=certifyNum]").val().length){
                $.alert("填写资料不能为空");
                return false;
            }
            if(!(/^\d+$/.test($("input[name=phoneNo]").val()))){
                $.alert("手机号必须为数字");
                return false;
            }else if($("input[name=phoneNo]").val().length!=11){
                $.alert("手机号必须为11位数字");
                return false;
            }
            let items = $('#'+form).serialize()+'&type='+type;
            url = url+'?'+items;
            // console.log(url);return;

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