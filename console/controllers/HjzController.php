<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use console\models\Picture;

class HjzController extends Controller
{
    /**
     * Todo 添加去标题去日期正则
     * @param $url
     */
    public function actionSpider($url){
        $art = file_get_contents($url);
        //正则匹配
        $pattern = '#<!-- 主体内容 -->(.*?)<!-- 学装修装企导流 -->#si';
        preg_match_all($pattern,$art,$matches);
        //正则匹配 替换不要的标签
        $pattern2 = '#\<script\>(.*?)<\/script>#si';
        $content = preg_replace($pattern2,'',$matches[1][0]);
        $pattern3 = '#\<p\ style=\"font-size\:\ 16px\;color\:\ \#666\;\"\>(.*?)\<\/div\>#si';
        $content = preg_replace($pattern3,'',$content);
        $pattern4 = '#href=\"(.*?)\"#si';
        $content = preg_replace($pattern4,'',$content);
        $pattern5 = '/<\/div>/U';
        $content = preg_replace($pattern5,'',$content,1);

        //标题
        $pattern6 = '#\<h1\ class=\"ect\"\>(.*?)\<\/h1\>#si';
        preg_match_all($pattern6,$content,$matches2);
        $title = $matches2[1][0];
        //日期
        $time = time();

        p($content.PHP_EOL.PHP_EOL);
        P($title.PHP_EOL.PHP_EOL,0,1);
        $this->confirm("is go on?",true);
        $arr = [
            'title'=>$title,
            'content'=>$content,
            'author'=>"荟惠子",
            'keywords'=>$title,
            'is_open'=>0,
            'add_time'=>$time,
            'description'=>$title,
            'file_url'=>'http://hjzhome.image.alimmdn.com/hjzWebsite/390_543/case-img.jpg'
        ];
        try{
            Yii::$app->db_hjz->createCommand()->insert("ecs_article",$arr)->execute();
            p("success");
        }catch(\Exception $e){
            p($e->getMessage(),1);
        }
    }
}
