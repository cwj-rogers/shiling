<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<form action="<?= Url::toRoute(['yht/contract-create','tid'=>$tid,'tmp_name'=>$tmp_name])?>" method="post">
    <div class="weui-cells__title">甲方名称</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 0px">
                <p>甲方：</p>
            </div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="name1" type="text" placeholder="请输入文本" value="深圳市荟家装科技有限公司">
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

    <div class="weui-cells__title">合同约定最低业绩流水</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 20px">
                <p>最低流水</p>
            </div>
            <div class="weui-cell__ft">
                <div class="weui-count">
                    <a class="weui-count__btn weui-count__decrease"></a>
                    <input class="weui-count__number" name="money" type="number" value="10" style="font-size: 18px;width: 28px">
                    <a class="weui-count__btn weui-count__increase"></a>
                </div>
            </div>
            <div class="weui-cell__hd" style="width: 50px;text-align: center">万</div>
        </div>
    </div>


    <div class="weui-cells__title">经营地区门店</div>
    <div class="weui-cells weui-cells_form">
        <input type="hidden" name="date" value="2018年8月8号">
        <input type="hidden" name="date+1year" value="2019年8月8号">
        <input type="hidden" name="date2" value="2018年8月8号">
        <input type="hidden" name="date3" value="2018年8月8号">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">地区</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="area" type="text" >
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">门店</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="shop" type="text" >
            </div>
        </div>
    </div>

    <div class="weui-cell">
        <input type="submit" class="weui-btn weui-btn_primary">
    </div>

    <div class="weui-cells__tips">请按表单要求仔细认真填写信息, 信息提交生成云合同后不能再做修改</div>
</form>
<script>
    $(function () {
        var MAX = 99, MIN = 1;
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
