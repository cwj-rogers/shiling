<?php

namespace hjzhome\controllers;
use common\helpers\FuncHelper as output;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\db\Expression;

class IndexController extends \yii\web\Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        //case 案例数据
        $sql = 'SELECT g.goods_id,g.cat_id, g.goods_name, g.sales_volume,g.comments_number,g.goods_brief, g.goods_thumb, g.goods_img ' .
            'FROM ecs_goods AS g '.
            'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND '.
            'g.is_delete = 0 AND g.cat_id IN (\'594\',\'933\',\'971\',\'928\') AND g.goods_id NOT IN (2890,2700,2898,2808,2809) ORDER BY g.sort_order, g.goods_id DESC LIMIT 12';
        $res = Yii::$app->db_hjz->createCommand($sql)->queryAll();
        //根据模板要求分成2个一组
        $newRes = [];
        $count = ceil(count($res)/2);
        for ($i=1;$i<=$count;$i++){
            $newRes[$i][] = array_shift($res);
            if(!empty($res)) $newRes[$i][] = array_shift($res);
        }

        //VR方案
        $sql1 = 'SELECT g.goods_id,g.cat_id, g.goods_name, g.sales_volume,g.comments_number,g.goods_brief, g.goods_thumb, g.goods_img, g.market_price, gal.img_url, gal.img_id ' .
                'FROM ecs_goods AS g LEFT JOIN ecs_goods_gallery as gal on g.goods_id=gal.goods_id '.
                'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND g.goods_id IN (1980,2250,3434,3433,3432,3437,3435,3431,2443,1902,1678) '.
                'ORDER BY gal.img_id desc';
        $sql2 = "SELECT * FROM ($sql1) as ggal GROUP BY  ggal.goods_name";
        $vrres = Yii::$app->db_bw->createCommand($sql2)->queryAll();

        //资讯文章
        $query = new Query();
        $article = $query->from("ecs_article")->select("*")
            ->where(['article_type'=>[88,89]])
            ->limit(30)
            ->orderBy("add_time desc")
            ->all(Yii::$app->db_hjz);

        //1.截取文章内容 2.根据article_type分组
        $artByType = [];
        foreach ($article as $k=>$v){
            preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $v['content'], $chinese);
            $chinese = mb_substr(implode(',',$chinese[0]),0,200);
            $v['content'] = $chinese;

            //全部
            if (!array_key_exists(0, $artByType)){
                $artByType[0][] = $v;
            }elseif (count($artByType[0])<=5){
                $artByType[0][] = $v;
            }
            //分类
            if (!array_key_exists($v['article_type'],$artByType)){
                $artByType[$v['article_type']][] = $v;
            }elseif (count($artByType[$v['article_type']])<=5){
                $artByType[$v['article_type']][] = $v;
            }
        }
//        p($artByType,1);
        return $this->render('index2',['case'=>$newRes,'vr'=>$vrres, 'article'=>$artByType, 'artType'=>array_keys($artByType)]);
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
        //VR方案
        $sql1 = 'SELECT g.goods_id,g.cat_id, g.goods_name, g.sales_volume,g.comments_number,g.goods_brief, g.goods_thumb, g.goods_img, g.market_price, gal.img_url, gal.img_id ' .
            'FROM ecs_goods AS g LEFT JOIN ecs_goods_gallery as gal on g.goods_id=gal.goods_id '.
            'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND g.goods_id IN (1980,2250,3434,3433,3432,3437,3435,3431,2443,1902,1678) '.
            'ORDER BY gal.img_id desc';
        $sql2 = "SELECT * FROM ($sql1) as ggal GROUP BY  ggal.goods_name";
        $vrres = Yii::$app->db_bw->createCommand($sql2)->queryAll();
        //p($vrres);
        return $this->render('picture2',['vrres'=>$vrres]);
    }

    /**
     * 装修资讯
     * @return string
     */
    public function actionNews($type=0){
        $type = $type? [$type]:[88,89];
        //资讯文章
        $query = new Query();
        $article = $query->from("ecs_article")->select("*")
            ->where(['article_type'=>$type])
            ->limit(5)
            ->orderBy("add_time desc")
            ->all(Yii::$app->db_hjz);

        $artRList = $query->from("ecs_article")->select("article_id,title,file_url,add_time")
            ->where(['article_type'=>[88,89]])
            ->limit(5)
            ->orderBy("add_time desc")
            ->all(Yii::$app->db_hjz);

        foreach ($article as $k=>$v){
            preg_match_all("/[\x{4e00}-\x{9fa5}]+/u", $v['content'], $chinese);
            $chinese = mb_substr(implode(',',$chinese[0]),0,200);
            $article[$k]['content'] = $chinese;
        }

        return $this->render('news2',['article'=>$article,'artRList'=>$artRList]);
    }

    public function actionShownews($artid=0){
        //统计文章点击次数
        Yii::$app->db_hjz->createCommand()->update("ecs_article",["click"=>new Expression("`click`+1")],['article_id'=>$artid])->execute();

        $query = new Query();
        $article = $query->from("ecs_article")->select("*")
            ->where(['article_id'=>$artid])
            ->orderBy("add_time desc")
            ->one(Yii::$app->db_hjz);

        $artRList = $query->from("ecs_article")->select("article_id,title,file_url,add_time")
            ->where(['article_type'=>[88,89]])
            ->limit(5)
            ->orderBy("add_time desc")
            ->all(Yii::$app->db_hjz);

        return $this->render('shownews',['article'=>$article,'artRList'=>$artRList]);
    }

    //简单单页
    public function actionPage($id,$tmp=null){
        $query = new Query();
        if ($tmp=='good'){
            $res = $query->from("ecs_goods")
                ->select("goods_id,goods_name as title,goods_desc as intro")
                ->where(["goods_id"=>$id])
                ->one(Yii::$app->db_bw);
            $res['keywords'] = "NEGATIVE IONS FITNESS DECORATE";
        }else{
            $res = $query->from("ecs_topic")
                ->where(["topic_id"=>$id])
                ->one(Yii::$app->db_bw);
        }
        //p($res,1);
        return $this->render('page',['content'=>$res]);
    }

    //商品详情页
    public function actionGoods($goods_id){
        $query = new Query();
        $res = $query->from("ecs_goods")
            ->select("goods_id,goods_name,goods_desc as intro,last_update,click_count")
            ->where(["goods_id"=>$goods_id])
            ->one(Yii::$app->db_bw);
        //标题美化
        $res['title'] = mb_strpos($res['goods_name'],'预')?mb_strrchr($res['goods_name'],'预',true):$res['goods_name'];

        $pregRule = "/<p style=\"(.*)<\/p>/U";
        preg_match_all($pregRule, $res['intro'], $matches);//正则匹配图片地址
        $iframe = array_pop($matches[0]);
        $pregRuleIf = "/src=\"(.*)\"/U";
        preg_match($pregRuleIf, $iframe, $src);//正则匹配
        $src = isset($src[1])&&!empty($src[1])? $src[1]:"";

        //右侧推荐方案
        $rand = array_rand(array_flip(explode(',',"1980,2250,3434,3433,3432,3437,3435,3431,2443,1902,1678")),5);
        $sql1 = 'SELECT g.goods_id,g.goods_name,g.goods_thumb, g.goods_img, g.goods_sn ' .
            'FROM ecs_goods AS g '.
            'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND g.goods_id IN ('.implode(',',$rand).') ';
        $vrres = Yii::$app->db_bw->createCommand($sql1)->queryAll();
        //p(mb_strpos($res['goods_name'],'预'),1);
        return $this->render('goods',['res'=>$matches[0],'src'=>$src,'goods'=>$res,'vrres'=>$vrres]);
    }

    public function actionCase($page=1){
        $offsetNum = ($page-1)*12;
        //case 案例数据
        $sql = 'SELECT g.goods_id, g.cat_id, g.goods_name, g.sales_volume,g.comments_number,g.goods_brief, g.goods_thumb, g.goods_img ' .
            'FROM ecs_goods AS g '.
            'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND '.
            'g.is_delete = 0 AND g.cat_id IN (928,933,971,922,941,920,926,929,932,944,946,916,936,923,925,921,945,978,924,939,927,937,940,954,931,935,938,943) ORDER BY g.sort_order, g.goods_id DESC offset 0 LIMIT 12';
        $query = new Query();
        $res = $query->from("ecs_goods g")
            ->select("g.goods_id, g.cat_id, g.goods_name, g.sales_volume,g.comments_number,g.goods_brief, g.goods_thumb, g.goods_img")
            ->where("g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND g.cat_id IN (928,933,971,922,941,920,926,929,932,944,946,916,936,923,925,921,945,978,924,939,927,937,940,954,931,935,938,943)")
            ->orderBy("g.sort_order, g.goods_id DESC")
            ->offset($offsetNum)->limit(12)
            ->all(Yii::$app->db_hjz);

        if (Yii::$app->request->isAjax){
            if (!empty($res)){
                output::ajaxReturn(200,'success',$res);
            }else{
                output::ajaxReturn(203,'no info');
            }
        }
        //p($res);
        return $this->render('case2',['res'=>$res]);
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
