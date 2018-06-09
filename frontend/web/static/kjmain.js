$(function () {

    // $('.progress-bar').popover('show');
    $('.progress-bar').tooltip('show');

    //获取process长度,标签移动到计算位置
    $('.tooltip').css('left',0);
    var  move_distance = $('.progress-bar-danger').width()-$('.tooltip').width()/2;
    $('.tooltip').animate({left:move_distance},1500);

    //分享弹窗
    $('#wx-share .weui_mask, #wx-share .weui_dialog_ft, .kj-share').click(function () {
        var stata = $('#wx-share').css('display');
        if (stata=="none"){
            $('#wx-share').show();
            $('#wx-share .weui_dialog').show().addClass('bounceInUp');
        } else{
            $('#wx-share').fadeOut();
        }
    })

    //排行榜弹窗
    $('#wx-rank-list .weui_mask, #wx-rank-list .weui_dialog_ft, .kj-rank-list').click(function () {
        var stata = $('#wx-rank-list').css('display');
        if (stata=="none"){
            $('#wx-rank-list').show();
            $('#wx-rank-list .weui_dialog').show().addClass('bounceInUp');
        } else{
            $('#wx-rank-list').fadeOut();
        }
    })

    //规则弹窗
    $('#wx-rule .weui_mask, #wx-rule .cancel, .act-rule').click(function () {
        var stata = $('#wx-rule').css('display');
        if (stata=="none"){
            $('#wx-rule').show();
            $('#wx-rule .weui_dialog').show().addClass('bounceInUp');
        } else{
            $('#wx-rule').fadeOut();
        }
    })
});