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
        $sql = 'SELECT g.goods_id,g.cat_id, g.goods_name, g.sales_volume,g.comments_number,g.goods_brief, g.goods_thumb, g.goods_img ' .
            'FROM ecs_goods AS g WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND '.
            'g.is_delete = 0 AND g.goods_id IN (1980,2250,3434,3433,3432) ORDER BY g.sort_order, g.goods_id DESC LIMIT 6';
        $videores = Yii::$app->db_hjz->createCommand($sql)->queryAll();
        return $this->render('index2',['case'=>$newRes,'videores'=>$videores]);
    }

    public function actionAbout(){
        if (Yii::$app->request->isPost){
            if (!empty($_POST)){
                $info = Yii::$app->request->post();
                $data = date("Y-m-d H:i:s").PHP_EOL.
                    "姓名：{$info['para115']}  电话：{$info['para116']}  邮箱：{$info['para117']}".PHP_EOL.
                    "内容：{$info['para118']}".PHP_EOL.PHP_EOL;

                $file = Yii::getAlias("@app/views/demo/contact.txt");
                file_put_contents($file,$data,FILE_APPEND);
                return $this->render('@app/views/public/success',['message'=>'提交成功','waitSecond'=>3,'jumpUrl'=>Yii::$app->request->referrer]);
            }
        }
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

    /**
     * 查看留言
     * @return string
     */
    public function actionMessage(){
        if ($pwd = Yii::$app->request->get('password',null)){
            if ($pwd=="hjzhome888"){
                $file = Yii::getAlias("@app/views/demo/contact.txt");
                $info = file_get_contents($file);
                return $this->render('message2',['info'=>$info,'checkout'=>1]);
            }else{
                return $this->render('@app/views/public/error',['message'=>'密码错误','waitSecond'=>3,'jumpUrl'=>'message']);
            }
        }else{
            return $this->render('message2',['info'=>'','checkout'=>0]);
        }
    }

    /**
     * 前台获取配置
     */
    public function actionUidata(){
        $arr = ["config"=>["met_online_type"=>"3", "met_stat"=>"0"]];
        echo json_encode($arr);
    }

    // 获取文件
    public function actionFile($name){
        if ($name=="bgmp3_cn"){
            $path = Yii::$app->basePath."/web/static/demo/audio_templatesM1156010minmusicbgmp3_cn.txt";
            $content = file_get_contents($path);
            echo $content;die;
        }
    }

    // 地址二级联动
    public function actionRegion($url){
        if (Yii::$app->request->isAjax){
            $res = file_get_contents($url);
            echo $res;die;
        }
    }

    // 提交免费设计
    public function actionFree(){
        if (Yii::$app->request->isPost){
            if (!empty($_POST)){
                $data = "省份城市：{$_POST['province']}-{$_POST['city']}，房屋面积：{$_POST['area']}，姓名：{$_POST['name']}，手机号：{$_POST['phone']}".PHP_EOL;
                $file = Yii::getAlias("@app/views/demo/info.txt");
                file_put_contents($file,$data,FILE_APPEND);
                return $this->render('@app/views/public/success',['message'=>'提交成功','waitSecond'=>3,'jumpUrl'=>'index#video']);
            }
        }
    }
}
