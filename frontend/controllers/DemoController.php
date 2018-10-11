<?php

namespace frontend\controllers;
use \common\helpers\FuncHelper as output;
use Yii;

class DemoController extends \yii\web\Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        //case 案例数据
        $sql = 'SELECT g.goods_id,g.cat_id, g.goods_name, g.sales_volume,g.comments_number,g.goods_brief, g.goods_thumb, g.goods_img ' .
            'FROM ecs_goods AS g WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND '.
            'g.is_delete = 0 AND g.cat_id IN (\'594\',\'933\',\'971\',\'928\') AND g.goods_id NOT IN (2890,2700,2898,2808,2809) ORDER BY g.sort_order, g.goods_id DESC LIMIT 12';
        $res = Yii::$app->db_hjz->createCommand($sql)->queryAll();
        $newRes = [];
        $count = ceil(count($res)/2);
        for ($i=1;$i<=$count;$i++){
            $newRes[$i][] = array_shift($res);
            if(!empty($res)) $newRes[$i][] = array_shift($res);
        }
        //p($newRes,1);
        return $this->render('index2',['case'=>$newRes]);
    }

    public function actionAbout(){
        return $this->render('about2');
    }

    public function actionServer(){
        return $this->render('server2');
    }

    public function actionPicture(){
        return $this->render('picture2');
    }

    public function actionNews(){
        return $this->render('news2');
    }

    public function actionCase(){
        if (Yii::$app->request->isAjax){
            $file = Yii::$app->basePath."/views/demo/case2.php";
            $content = file_get_contents($file);
            $pregRule = "/<ul[^>]*class=\"blocks-2 blocks-sm-3 blocks-md-4 blocks-xlg-4  met-page-ajax\"[^>]*>(.*?) <\/ul>/si";
            preg_match($pregRule,$content,$matches);
            //p($matches[1],1);
            echo trim($matches[1]);die;
        }
        return $this->render('case2');
    }

    public function actionCaseThumbnail(){

    }

    public function actionMessage(){
        return $this->render('message2');
    }

    /**
     * 前台获取配置
     */
    public function actionUidata(){
        $arr = ["config"=>["met_online_type"=>"3", "met_stat"=>"0"]];
        echo json_encode($arr);
    }
    public function actionFile($name){
        if ($name=="bgmp3_cn"){
            $path = Yii::$app->basePath."/web/static/demo/audio_templatesM1156010minmusicbgmp3_cn.txt";
            $content = file_get_contents($path);
            echo $content;die;
        }elseif (1){

        }
    }
}
