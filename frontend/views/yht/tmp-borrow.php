<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<header class="cont_header">
<!-- 468主材包优惠政策协议 -->
    <p><?= $tmp_name?></p>
    <a href="<?= Url::toRoute(['yht/contract-demo','contractId'=>$demoId])?>" class="weui-btn weui-btn_primary cont-demo"><i class="weui-icon-search"></i>查看模板</a>
</header>
<form class="tmp-form" action="<?= Url::toRoute(['yht/contract-create','tid'=>$tid,'tmp_name'=>$tmp_name])?>" method="post">
    <div class="weui-cells__title">甲方</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>甲方(出借方)：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入文本" value="佛山市五只羊家居科技有限责任公司" disabled="disabled">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <p>住址：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入文本" value="佛山市禅城区季华路智慧新城T15栋1001 之二" disabled="disabled">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <p>电话：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入" value="0757-82701376" disabled="disabled">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">乙方</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>乙方(借款方)：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="name2" type="text" placeholder="请输入" value="">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>地址：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="addr2" type="text" placeholder="请输入" value="">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>联系电话：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="phone2" type="text" placeholder="请输入" value="">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>身份证号码：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="id2" type="text" placeholder="请输入" value="">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">借款的金额</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 10px">
                <p>借款总金额 ：</p>
            </div>
            <div class="weui-cell__ft">
                <div class="weui-count">
                    <a class="weui-count__btn weui-count__decrease"></a>
                    <input class="weui-count__number" name="money" type="number" value="10000" style="font-size: 18px;width: 80px">
                    <a class="weui-count__btn weui-count__increase"></a>
                </div>
            </div>
            <div class="weui-cell__hd" style="width: 30px;text-align: center">元</div>
        </div>
    </div>
    <div class="weui-cells__title">还款期限</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <p>借款时长 ：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入" value="15天" disabled="disabled">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <p>开始时间 ：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入" value="<?= date("Y年m月d日")?>" disabled="disabled">
                <input type="hidden" name="date"  value="<?= date("Y年m月d日")?>">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd">
                <p>结束时间 ：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入" value="<?= date("Y年m月d日",strtotime("+15day"))?>" disabled="disabled">
                <input type="hidden" name="date+15" value="<?= date("Y年m月d日",strtotime("+15day"))?>">
            </div>
        </div>
    </div>


    <div class="weui-cells__title">合同补充条款</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <textarea class="weui-textarea" placeholder="请输入文本" rows="6" name="other"></textarea>
                <div class="weui-textarea-counter"><span>0</span>/1000</div>
            </div>
        </div>
    </div>


    <div class="weui-cell tmp-submit">
        <input type="submit" class="weui-btn weui-btn_primary">
    </div>
    <div class="weui-cells__tips">请按表单要求仔细认真填写信息, 信息提交生成云合同后不能再做修改</div>

</form>
<script>
    $(function () {
        //初始化计数器
        weuiCount(['.weui-count__decrease','.weui-count__increase'], 8888888, 100, 100);
        //表单保存操作 1分钟保存一次
        setInterval(function (e) {
            let formInfo = $('.tmp-form').serializeArray();//console.log(formInfo);
            let localObj = JSON.stringify(formInfo);
            localStorage.backup = localObj;
            $.toast("自动保存记录");
        },1000*90);
        //日历选择器初始化
        initDate();
        //数据初始化自动填
        initRecoverBackup();
    });

    //初始化日期
    function initDate() {
        $("html").css('font-size','20px');// 为调整日历排版
        $(".dates").calendar({
            value: [$(".dates").attr('item')],
            dateFormat: 'yyyy年mm月dd日'  // 自定义格式的时候，不能通过 input 的value属性赋值 '2016年12月12日' 来定义初始值，这样会导致无法解析初始值而报错。只能通过js中设置 value 的形式来赋值，并且需要按标准形式赋值（yyyy-mm-dd 或者时间戳)
        });
    }
    //初始化备份表单
    function initRecoverBackup() {
        let backup = localStorage.backup;
        let backupObj = backup? JSON.parse(backup) : [];
        //console.log(backupObj);
        if (backupObj){
            $.each(backupObj,function (k,v) {
                if (v.name=='other'){
                    $("textarea[name="+v.name+"]").val(v.value);
                }else {
                    $("input[name="+v.name+"]").val(v.value);
                }
            });
        }
    }

</script>
