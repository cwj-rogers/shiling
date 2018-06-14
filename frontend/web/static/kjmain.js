$(function () {
    setTimeout(function () {
        //获取process长度,标签移动到计算位置
        $('.progress-bar').tooltip('show');
        var tooltip_length = $('.tooltip').width()/2;//砍价标签长度
        $('.tooltip').css('left',-tooltip_length);
        var move_distance = $('.progress-bar-danger').width() - tooltip_length;
        if(move_distance>0) $('.tooltip').animate({left:move_distance},1500);
    },1000);

    //分享弹窗
    $('#wx-share .weui_mask, #wx-share .weui_dialog_ft, .kj-share-btn').click(function () {
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
    });

    $('.cd-item').each(function () {
        countDown($(this).attr("cd-name"),$(this).attr("cd-date"));
    });
});

// 活动结束计时器
function countDown(className,date) {
    var starttime = new Date(date);
    setInterval(function () {
        var nowtime = new Date();
        var time = starttime - nowtime;
        var day = parseInt(time / 1000 / 60 / 60 / 24);
        var hour = parseInt(time / 1000 / 60 / 60);
        var minute = parseInt(time / 1000 / 60 % 60);
        var seconds = parseInt(time / 1000 % 60);
        $(className).html('还剩' + hour + "时" + minute + "分" + seconds+ "秒");
        console.log(seconds);
    }, 1000);
}