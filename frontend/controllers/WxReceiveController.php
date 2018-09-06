<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Session;

class WxReceiveController extends Controller
{
    public function actionIndex()
    {
        //验证服务器
        if (Yii::$app->request->get('echostr',false)){
            //执行服务端业务
            $response = Yii::$app->wechat->server->serve();
            // 将响应输出
            return $response->send();
        }

        // 接受处理传来的消息
        Yii::$app->wechat->server->push(function ($message) {
            switch ($message['MsgType']) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });
//        return "欢迎关注我们公众号";
    }
}
