<?php
/* @var $this yii\web\View */
?>

<p>
    You may change the content of this page by modifying
    the file <code></code>.
</p>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="https://api.yunhetong.com/api_page/api/yht.js"></script>
<script type="text/javascript">
    $(function () {
        var tokenUnableListener = function (obj){ //当 token 不合法时，SDK 会回调此方法
            console.log(1);
            $.ajax({
                type:'POST',
                url:'https://api.yunhetong.com/api/auth/login',  //第三方服务器获取 token 的 URL，云合同 SDK 无法提供
                cache:false,
                dataType: 'json',
                data:{"appId": "2018062817051800007","appKey": "wceNcK55gQE"},  //第三方获取 token 需要的参数
                beforeSend:function (xhr){
                    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                },
                success: function(data,textStatus,request){
                    console.log(request.getResponseHeader("token"));
                    YHT.setToken(request.getResponseHeader("token"));  //重新设置token，从请求头获取 token
                    YHT.do(obj); //调用此方法，会继续执行上次未完成的操作
                },
                error: function (data) {
                    // alert(data);
                    console.log(data);
                }
            });
        };
        tokenUnableListener({});
        YHT.init("AppID", tokenUnableListener);  //必须初始化 YHT
        //获取合同列表
        // $.ajax({
        //     type:'GET',
        //     async:false,  //请使用同步
        //     url:'https://testapi.yunhetong.com/api/contract/list',  //第三方服务器获取合同 ID 的 URL
        //     cache:false,
        //     dataType:'json',
        //     data:{searchType:1,searchId:'2018062817051800007',stateType:0,pageNum:1,pageSize:20},
        //     success: function(data, textStatus, jqXHR){
                var contractId='1807021639542453';
                //合同查看方法
                // YHT.queryContract(
                //     function successFun(url) {
                //         console.log(url);
                //         window.open(url);
                //     },
                //     function failFun(data) {
                //         alert(data);
                //     },
                //     contractId
                // );
                //合同签署页面
                // YHT.signContract(
                //     function successFun(url) {
                //         window.open(url);
                //     },
                //     function failFun(data) {
                //         console.log(data);
                //     },
                //     contractId
                // );
                //前置绘制签名页面
                // YHT.dragSignF(
                //     function successFun(url) {
                //         window.open(url);
                //     },
                //     function failFun(data) {
                //         console.log(data);
                //     }
                // );
            // },
            // error: function (data) {
            // }
        // });

    })
</script>