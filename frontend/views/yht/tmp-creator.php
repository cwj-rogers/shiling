<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<link href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
<div class="weui_cells weui_cells_form">
    <?php foreach ($list as $k=>$v):?>
    <div class="weui_cell">
        <div class="weui_cell_hd"><label class="weui_label">qq</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <input class="weui_input" type="tel" placeholder="请输入qq号">
        </div>
    </div>
    <?php endforeach;?>

    <div class="weui_cell weui_vcode">
        <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <input class="weui_input" type="number" placeholder="请输入验证码">
        </div>
        <div class="weui_cell_ft">
<!--            <img src="/assets/img/vcode.jpg">-->
        </div>
    </div>
    <div class="weui_cell weui_cell_switch">
        <div class="weui_cell_hd weui_cell_primary">接受通知</div>
        <div class="weui_cell_ft">
            <input class="weui_switch" type="checkbox">
        </div>
    </div>
    <div class="weui_cell">
        <div class="weui_cell_hd"><label for="" class="weui_label">日期</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <input class="weui_input" type="date" value="">
        </div>
    </div>
    <div class="weui_cell">
        <div class="weui_cell_hd"><label for="" class="weui_label">时间</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <input class="weui_input" type="datetime-local" value="" placeholder="">
        </div>
    </div>
    <div class="weui_cell weui_cell_select">
        <div class="weui_cell_bd weui_cell_primary">
            <select class="weui_select" name="select1">
                <option selected="" value="0">选择</option>
                <option value="1">微信号</option>
                <option value="2">QQ号</option>
                <option value="3">Email</option>
            </select>
        </div>
    </div>
</div>
<div class="weui_cells_title">文本域</div>

<div class="weui_cells weui_cells_form">
    <div class="weui_cell">
        <div class="weui_cell_bd weui_cell_primary">
            <textarea class="weui_textarea" placeholder="请输入评论" rows="3"></textarea>
            <div class="weui_textarea_counter"><span>0</span>/200</div>
        </div>
    </div>
</div>
<!--<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/yht.js"></script>-->
<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/m/yht.js"></script>


