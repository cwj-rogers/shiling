<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=yes" />
<script type="text/javascript" charset="utf-8">
    //微信分享配置
    var detailUrl = <?= json_encode(Url::toRoute(["yht/contract-detail",'contractId'=>$contractId], true))?>;
    var localUrl = "http://www.hjzhome.com";
    var authority = <?= $authority?>;
    let yhturl = authority===3? localUrl:detailUrl;//乙方限制分享权限
    wx.ready (function () {
        var $wx_share = [
            'http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/%E4%BA%91%E5%90%88%E5%90%8C/splash_1532757769.png?t=1533178660358',
            yhturl,
            <?= json_encode($contTitle)?>,
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
                $.alert("合同已成功发送,到微信@朋友吧","分享成功");
            }
        };
        //只支持发送给朋友
        wx.onMenuShareAppMessage (shareData);
    });
</script>
<div id="sectionB">
    <iframe id="contract-box" src="" frameborder="0" marginheight=0 marginwidth=0 scrolling="auto" style="height: 500px;width: 100%"></iframe>
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
    <div id="personal" class="hide weui-popup__container popup-bottom register-step user-type">
        <div class="weui-popup__overlay"></div>
        <form action="" class="form-personal">
        <div class="weui-popup__modal">
            <div class="top">个人用户</div>
            <hr>
            <div class="bottom">
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
                <a href="javascript:;" class="submit-info weui-btn weui-btn_default" form="form-personal">提交</a>
            </div>
        </div>
        </form>
    </div>
    <!--  企业用户  -->
    <div id="company" class="hide weui-popup__container popup-bottom register-step user-type">
        <div class="weui-popup__overlay"></div>
        <form action="" class="form-company">
        <div class="weui-popup__modal">
            <div class="top">企业用户</div>
            <hr>
            <div class="bottom">
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
                    <a href="javascript:;" class="explain-submit weui-btn weui-btn_primary">确定无误</a>
                </div>
            </div>
        </div>
    </div>

    <!--  下载合同链接  -->
    <div id="download" style="display: none;top: 60px;">
        <a href="javascript:;" class="weui-flex">
            <div class="weui-flex__item">
                <i class="weui-icon-download" style="color: white;font-size: 28px"></i>
            </div>
            <div class="weui-flex__item yht-download">下载合同</div>
        </a>
    </div>
</div>

<!-- 根据不同的客户端访问加载不同JS -->
<?php if (!Yii::$app->wechat->isWechat):?>
    <script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/yht.js"></script>
<?php else:?>
    <script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/m/yht.js"></script>
<?php endif;?>
<script type="text/javascript">

    $(function () {
        //测试功能
        // $("#signature").removeClass('hide').popup();
        // $.verifyPrompt({'obj':{'phoneNo':10086}});
        // countDown(".weui-dialog .count-down");
        let isWechat = <?= json_encode(Yii::$app->wechat->isWechat)?>;
        let conStatus = <?= json_encode($status)?>;
        var type = 0;
        var contractId = <?= $contractId?>;
        var signerId = 0;
        var moulageId = 0;
        var countdownTime = 60;//倒计时60秒
        $.showLoading("正在载入合同");
        setTimeout(function () {
            $.hideLoading();
        },3500);
        if(isWechat){
            if (conStatus){
                // 微信端 + 签署完成
                $("#download").show().click(function () {
                    location.href = <?= json_encode(Url::toRoute(['yht-login/down-url','contractId'=>$contractId]))?>;
                });
            }
        }else{
            //PC 端全屏查看
            $("#container").css('max-width','100%');
        }

        //下载合同功能

        //6.1 获取短信信息 a.添加签署人+静默签署 b.获取短信 c.验证短信+ 双方签署成功
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
                        if (data.obj.verifyPhone==1){
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
                                        // location.href = utlVerifySuccess;
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
        //6.2 获取短信+短信验证
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
                    $.showLoading('等待验证');
                    $.getJSON(urlVerify,function (data) {
                        if (data.code==200){
                            $.hideLoading();
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
            //是否已经同意云合同条款
            if (explainStatus==0){
                $.toast("注册前请仔细阅读云合同条款","text",function () {
                    $("#explain").popup();
                });
                return false;
            }
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

            var url = <?= json_encode(Url::toRoute(['yht/create-user']))?>;
            var form = $(this).attr("form");
            var items = $('.'+form).serialize()+'&type='+type;
            url = url+'?'+items;
            console.log(url);
            if (type>0){
                $.showLoading('信息验证中');
                $.getJSON(url,function (data) {
                    console.log(data);
                    $.hideLoading();
                    if (data.code===200){
                        signerId = data.obj.signerId;
                        moulageId = data.obj.moulageId;
                        $.alert('<i class="weui-icon-success weui-icon_msg"></i>', "认证成功,领取专属印章", function() {
                            //点击确认,1.获取印模base64 2.打开签名页
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
        //4.1 电子合同条款
        let explainStatus = 0;
        $("#explain .weui-cell__hd").click(function () {
            let status = $("input[type='checkbox']").prop('checked');
            console.log(status);
            if (status==false){
                explainStatus = 0;
            } else{
                explainStatus = 1;
            }
        });
        $("#explain .explain-submit").click(function () {
            $.closePopup();
            if(type == 1){
                $("#personal").removeClass('hide').popup();
            }else{
                $("#company").removeClass('hide').popup();
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


        //2.进入签约 判断是否已注册云合同用户 是,跳到签名页 否,进入注册流程
        $('#sectionB').on('click','.sign',function () {
            if(type == 1){
                $("#personal").removeClass('hide').popup();
                return false;
            }else if (type == 2) {
                $("#company").removeClass('hide').popup();
                return false;
            }
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


