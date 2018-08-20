<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<header class="cont_header">
    <p>云合同资料填写</p>
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

    <div class="weui-cells__title">承诺发展城市合伙人数量</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">城市合伙人</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="cityPartners" type="text" placeholder="10" pattern="[0-9]*">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">承诺发展城市社区店数量</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">城市社区店</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="cityShops" type="text" placeholder="10" pattern="[0-9]*">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">承诺发展创客共享合伙人数量</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">创客共享合伙人</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" name="cityCreators" type="text" placeholder="10" pattern="[0-9]*">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">总销售业绩目标</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd" style="margin-right: 20px">
                <p>业绩目标</p>
            </div>
            <div class="weui-cell__ft">
                <div class="weui-count">
                    <a class="weui-count__btn weui-count__decrease"></a>
                    <input class="weui-count__number" name="cityTotal" type="number" value="100" style="font-size: 18px;width: 50px">
                    <a class="weui-count__btn weui-count__increase"></a>
                </div>
            </div>
            <div class="weui-cell__hd" style="width: 50px;text-align: center">万</div>
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
