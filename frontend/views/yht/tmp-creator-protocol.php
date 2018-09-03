<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<header class="cont_header">
    <p>城市合伙人授权经营协议书</p>
</header>
<form class="tmp-form" action="<?= Url::toRoute(['yht/contract-create','tid'=>$tid,'tmp_name'=>$tmp_name])?>" method="post">
    <div class="weui-cells__title">甲方名称</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>甲方：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入文本" value="深圳市荟家装科技有限公司" disabled="disabled">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">乙方名称</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>乙方：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="name2" type="text" placeholder="..." value="">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">经营地区门店</div>
    <div class="weui-cells weui-cells_form">
        <input type="hidden" name="date" value="<?= date("Y年m月d日")?>">
        <input type="hidden" name="date+1year" value="<?= date("Y年m月d日",strtotime('+1year'))?>">
        <input type="hidden" name="dateA" value="<?= date("Y年m月d日")?>">
        <input type="hidden" name="dateB" value="<?= date("Y年m月d日")?>">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">地区</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="area" type="text" placeholder="例:佛山市禅城区">
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
        var MAX = 1000, MIN = 10;
        $('.weui-count__decrease').click(function (e) {
            var $input = $(e.currentTarget).parent().find('.weui-count__number');
            var number = parseInt($input.val() || "0") - 1
            if (number < MIN) number = MIN;
            $input.val(number)
        })
        $('.weui-count__increase').click(function (e) {
            var $input = $(e.currentTarget).parent().find('.weui-count__number');
            var number = parseInt($input.val() || "0") + 1
            if (number > MAX) number = MAX;
            $input.val(number)
        })
    })
</script>
