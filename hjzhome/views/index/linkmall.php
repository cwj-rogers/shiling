<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://hjzhome.image.alimmdn.com/hjzWebsite/首页图/红底LOGO+500px.png" rel="shortcut icon" type="image/x-icon" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{font-family: '微软雅黑'; color: gray; font-size: 16px; }
.system-message{ padding: 24px 48px; padding-top: 96px}
.system-message .title{ font-size: 60px; font-weight: normal; line-height: 120px; margin-bottom: 12px;text-align: center;position: relative;z-index: 800}
.system-message .jump{ padding-top: 10px;margin-bottom:20px;text-align: center}
.system-message .jump a{ color: #333;text-align: center}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px;text-align: center;position: relative}
.system-message .success{display: flex;flex-direction: row;justify-content: center;align-items: center}
.system-message .success>p{width: 600px;height: 400px;position: relative}
.system-message .success>p>img{position: absolute;top:-150px;left: 0;z-index: 20}
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none;text-align: center}
#wait {
    font-size:46px;
}
#btn-stop,#href{
    display: inline-block;
    margin-right: 10px;
    font-size: 16px;
    line-height: 18px;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 0 none;
    background-color: #308B04;
    padding: 10px 20px;
    color: #fff;
    font-weight: bold;
    border-color: transparent;
    text-decoration:none;
}

#btn-stop:hover,#href:hover{
    background-color: #43BD08;
}
</style>
</head>
<body>
    <div class="system-message">
        <h2 class="title">请稍等正在进入商城</h2>
        <div class="success">
            <p>
                <img src="https://hjz888.oss-cn-shenzhen.aliyuncs.com/%E7%99%BE%E5%BA%A6%E8%AE%A4%E8%AF%81%E5%AE%98%E7%BD%91/timg.gif" alt="正在进入商城">
            </p>
        </div>
        <p class="detail"></p>
        <p class="jump" style="display: none">
            <b id="wait">1</b> 秒后页面将自动跳转
        </p>
        <div>
            <a id="href" id="btn-now" href="<?= 'http://mall.hjzhome.com/category.php?id=39'; ?>" style="display: none">立即跳转</a>
        </div>
    </div>

<script type="text/javascript">
(function(){
    var wait = document.getElementById('wait'), href = document.getElementById('href').href;
    var interval = setInterval(function(){
        var time = --wait.innerHTML;
        if(time <= 0) {
            location.href = href;
            clearInterval(interval);
        };
    }, 1000);
    window.stop = function (){
        clearInterval(interval);
    }
})();
</script>
</body>
</html>
