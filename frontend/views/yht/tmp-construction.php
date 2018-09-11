<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<header class="cont_header">
    <p><?= $tmp_name?></p>
    <a href="<?= Url::toRoute(['yht/contract-demo','contractId'=>$demoId])?>" class="weui-btn weui-btn_primary cont-demo"><i class="weui-icon-search"></i>查看模板</a>
</header>
<style>
    .weui-count .weui-count__increase2:after, .weui-count .weui-count__increase2:before{background-color: white}
</style>
<form class="tmp-form" action="<?= Url::toRoute(['yht/contract-create','tid'=>$tid,'tmp_name'=>$tmp_name])?>" method="post">
    <div class="weui-cells__title">发包方(以下简称甲方)</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>发包方：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="name1" type="text" placeholder="请输入">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>代表：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="principal1" type="text" placeholder="请输入">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>身份证号码：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="certifyNum1" type="text" placeholder="请输入">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>通讯地址：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="addr1" type="text" placeholder="请输入">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>联系电话：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="phone1" type="text" placeholder="请输入">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">承包方(以下简称乙方)</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>承包方：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="..." value="深圳市荟家装科技有限公司" disabled="disabled">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>代表：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="principal2" type="text" placeholder="请输入" value="">
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
                <p>工程负责人：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="principal3" type="text" placeholder="请输入" value="">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">工程概况</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>工程地址：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="addr2" type="text" placeholder="请输入" value="">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>工程开工日期：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="date" type="text" placeholder="请输入" value="" data-toggle='date' item="<?= date("Y-m-d")?>">
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 10px">
                <p class="sm">工程施工完工天数：</p>
            </div>
            <div class="weui-cell__ft">
                <div class="weui-count">
                    <a class="weui-count__btn weui-count__decrease2"></a>
                    <input class="weui-count__number" name="day" type="number" value="60" style="font-size: 18px;width: 50px">
                    <a class="weui-count__btn weui-count__increase2" style="background-color: #04BE02;}"></a>
                </div>
            </div>
            <div class="weui-cell__hd" style="width: 30px;text-align: center">天</div>
        </div>
    </div>

    <div class="weui-cells__title">工程价款</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 10px">
                <p>工程总造价 ：</p>
            </div>
            <div class="weui-cell__ft">
                <div class="weui-count">
                    <a class="weui-count__btn weui-count__decrease"></a>
                    <input class="weui-count__number" name="money2" type="number" value="100000" style="font-size: 18px;width: 80px">
                    <a class="weui-count__btn weui-count__increase"></a>
                </div>
            </div>
            <div class="weui-cell__hd" style="width: 30px;text-align: center">元</div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p class="xs">工程总造价（金额大写）：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="money1" type="text" placeholder="..." value="" readonly  unselectable="on" >
            </div>
        </div>
    </div>

    <div class="weui-cells__title">付款方式</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 10px">
                <p>定金 ：</p>
            </div>
            <div class="weui-cell__ft">
                <div class="weui-count">
                    <a class="weui-count__btn weui-count__decrease"></a>
                    <input class="weui-count__number" name="money3" type="number" value="5000" style="font-size: 18px;width: 80px">
                    <a class="weui-count__btn weui-count__increase"></a>
                </div>
            </div>
            <div class="weui-cell__hd" style="width: 30px;text-align: center">元</div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 10px">
                <p class="sm">签订合同第一期(60%) ：</p>
            </div>
            <div class="weui-cell__ft">
                <div class="weui-count">
                    <a class="weui-count__btn weui-count__decrease"></a>
                    <input class="weui-count__number" name="money4" type="number" value="60000" style="font-size: 18px;width: 80px">
                    <a class="weui-count__btn weui-count__increase"></a>
                </div>
            </div>
            <div class="weui-cell__hd" style="width: 30px;text-align: center">元</div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 10px">
                <p class="sm">施工过程第二期(38%) ：</p>
            </div>
            <div class="weui-cell__ft">
                <div class="weui-count">
                    <a class="weui-count__btn weui-count__decrease"></a>
                    <input class="weui-count__number" name="money5" type="number" value="38000" style="font-size: 18px;width: 80px">
                    <a class="weui-count__btn weui-count__increase"></a>
                </div>
            </div>
            <div class="weui-cell__hd" style="width: 30px;text-align: center">元</div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 10px">
                <p class="sm">竣工验收(余款) ：</p>
            </div>
            <div class="weui-cell__ft">
                <div class="weui-count">
                    <a class="weui-count__btn weui-count__decrease"></a>
                    <input class="weui-count__number" name="money6" type="number" value="2000" style="font-size: 18px;width: 80px">
                    <a class="weui-count__btn weui-count__increase"></a>
                </div>
            </div>
            <div class="weui-cell__hd" style="width: 30px;text-align: center">元</div>
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

    <input type="hidden" name="dateA" value="<?= date("Y年m月d日")?>">
    <input type="hidden" name="dateB" value="<?= date("Y年m月d日")?>">

    <div class="weui-cell tmp-submit">
        <input type="submit" class="weui-btn weui-btn_primary">
    </div>
    <div class="weui-cells__tips">请按表单要求仔细认真填写信息, 信息提交生成云合同后不能再做修改</div>

</form>
<script>
    // var S2B = {};
    $(function () {
        weuiCount(['.weui-count__decrease','.weui-count__increase'], 8888888, 10, 100, S2B);
        weuiCount(['.weui-count__decrease2','.weui-count__increase2'], 365, 1, 1);

        //表单保存操作 1分钟保存一次
        setInterval(function (e) {
            let formInfo = $('.tmp-form').serializeArray();//console.log(formInfo);
            let localObj = JSON.stringify(formInfo);
            localStorage.backup = localObj;
            $.toast("自动保存记录");
        },1000*90);
        $("input[name=money2]").change(function (e) {
            S2B();
        });

        //日历选择器初始化
        initDate();
        //数据初始化自动填
        initRecoverBackup();
        //金额初始化动作
        // S2B();
    });
    //初始化日期
    function initDate() {
        $("html").css('font-size','20px');// 为调整日历排版
        $("input[name=date]").calendar({
            value: [$("input[name=date]").attr('item')],
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
    //金额初始化
    var S2B = function (){
        let money2 = parseInt($("input[name=money2]").val());
        $("input[name=money1]").val(smalltoBIG(money2));
        //分期价格重新算
        $("input[name=money4]").val(parseFloat(money2*0.6));
        $("input[name=money5]").val(parseFloat(money2*0.38));
    }
    //金额小写转大写
    function smalltoBIG(n)
    {
        var fraction = ['角', '分'];
        var digit = ['零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖'];
        var unit = [ ['元', '万', '亿'], ['', '拾', '佰', '仟']  ];
        var head = n < 0? '欠': '';
        n = Math.abs(n);

        var s = '';

        for (var i = 0; i < fraction.length; i++)
        {
            s += (digit[Math.floor(n * 10 * Math.pow(10, i)) % 10] + fraction[i]).replace(/零./, '');
        }
        s = s || '整';
        n = Math.floor(n);

        for (var i = 0; i < unit[0].length && n > 0; i++)
        {
            var p = '';
            for (var j = 0; j < unit[1].length && n > 0; j++)
            {
                p = digit[n % 10] + unit[1][j] + p;
                n = Math.floor(n / 10);
            }
            s = p.replace(/(零.)*零$/, '').replace(/^$/, '零')  + unit[0][i] + s;
        }
        return head + s.replace(/(零.)*零元/, '元').replace(/(零.)+/g, '零').replace(/^整$/, '零元整');
    }

</script>
