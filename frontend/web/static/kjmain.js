
    // 进度条
    setTimeout(function () {
        //获取process长度,标签移动到计算位置
        $('.progress-bar').tooltip('show');
        var tooltip_length = $('.tooltip').width()/2;//砍价标签长度
        $('.tooltip').css('left',-tooltip_length);
        var move_distance = $('.progress-bar-danger').width() - tooltip_length;
        if(move_distance>0) $('.tooltip').animate({left:move_distance},1500);
    },1000);

    //分享弹窗
    $('#wx-share .weui_mask, #wx-share .weui_dialog_ft, #wx-share .share-icon-box, .kj-share-btn, #kj-success .btn').click(function () {
        var stata = $('#wx-share').css('display');
        if (stata=="none"){
            $('#wx-share').show();
            $('#wx-share .weui_dialog').show().addClass('bounceInUp');
        } else{
            $('#wx-share').fadeOut();
            $('#wx-share .icon-box').fadeOut();
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

    //砍价成功弹窗
    $('#kj-success .weui_mask, #kj-success .cancel, .join-num, #kj-success .btn').click(function () {
        var stata = $('#kj-success').css('display');
        if (stata=="none"){
            $('#kj-success').show();
            $('#kj-success .weui_dialog').show().addClass('zoomIn');
            var player = $("#player")[0]; /*jquery对象转换成js对象*/
            player.play(); /*播放*/
            setTimeout(function () {
                $('#kj-success .kj-gif').show().addClass('zoomIn');
            },1500);
            setTimeout(function () {
                $('#kj-success .kj-gif').find("img").animate({height:'180px'},"slow");
                $('#kj-success .kj-info-box').show().addClass('bounceInUp');
            },3000);
        } else{
            $('#kj-success').fadeOut();
            $('#kj-success .kj-info-box').fadeOut();
            $('#kj-success .kj-gif').fadeOut();
            $('#kj-success .kj-gif').find("img").animate({height:'300px'});
        }
    });

//定时器
$('.cd-item').each(function () {
    countDown($(this).attr("cd-name"),$(this).attr("cd-date"));
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

//Toast
function toast(content='已完成') {
    var $toast = $('#toast');
    $toast.find('.weui_toast_content').text(content);
    if ($toast.css('display') != 'none') return;
    $toast.fadeIn(300);
    setTimeout(function () {
        $toast.fadeOut(300);
    }, 2000);
}