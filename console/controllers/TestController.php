<?php

namespace console\controllers;
use Yii;
use yii\db\Query;

class TestController extends \yii\console\Controller
{
    public function actionIndex($start='', $end='')
    {
        Yii::$app->setComponents([
           'db'=>[
               'class'       => 'yii\db\Connection',
               'dsn'         => 'mysql:host=gz-cdb-ecmy83dx.sql.tencentcdb.com;port=62387;dbname=bdm314524321_db',
               'username'    => 'root',
               'password'    => 'hjzhome888',
               'charset'     => 'utf8',
               'tablePrefix' => 'ecs_',
           ]
        ]);
        $info = (new Query())->from("ecs_goods")
            ->select("goods_id,goods_desc,is_real,is_delete,is_on_sale")
            ->where(['between','goods_id',$start,$end])
            ->andWhere("is_real=0 or is_delete=1")
//            ->where(["goods_id"=>212])
            ->all();
//        p($info,1);
//        $regImg = '/<img[^>]*src\s*=\s*[\"|\']?\s*([^>\"\'\s]*)(\">|\"\/>)/i';
//        $imgpreg = '/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i';
//        $match_str = "/<img.*srcs*=s*[\"|']?s*([^>\"'s]*)/i";

        foreach ($info as $k=>$v){
//            preg_match_all("/src=\"(.*)\"/U", $v['goods_desc'], $matches);
//            $images = implode(",", $matches[1]);
            p("num:{$k}, goods_id:{$v['goods_id']}, is_real:{$v['is_real']}, is_delete:{$v['is_delete']}".PHP_EOL.PHP_EOL);
            @Yii::$app->db->createCommand()->update('move_ali_log',["goods_desc_images"=>""],["good_id"=>$v['goods_id']])->execute();
            usleep(1000);
        }




//        $this->stdout('hello world');
    }

    public function actionGoodsDesc($start="",$end=""){
        Yii::$app->setComponents([
            'db'=>[
                'class'       => 'yii\db\Connection',
                'dsn'         => 'mysql:host=gz-cdb-ecmy83dx.sql.tencentcdb.com;port=62387;dbname=bdm314524321_db',
                'username'    => 'root',
                'password'    => 'hjzhome888',
                'charset'     => 'utf8',
                'tablePrefix' => 'ecs_',
            ]
        ]);
        $info = (new Query())->from("ecs_goods")
            ->select("goods_id,goods_desc,is_real,is_delete,is_on_sale")
            ->where(['between','goods_id',$start,$end])
            ->andWhere("is_real=1 and is_delete=0")
            //            ->where(["goods_id"=>212])
            ->all();

        foreach ($info as $k=>$v){
            //添加图片前缀
            $newct = $this->get_img_thumb_url($v['goods_desc'],"http://image.hjzhome.com");
            @Yii::$app->db->createCommand()->update('ecs_goods',["goods_desc"=>$newct],["goods_id"=>$v['goods_id']])->execute();
            p("num:{$k}, goods_id:{$v['goods_id']}".PHP_EOL.PHP_EOL);
            usleep(1000);
        }

    }

    /**
     * 图片地址替换成压缩URL
     * @param string $content 内容
     * @param string $suffix 后缀
     */
    function get_img_thumb_url($content="",$prefix="",$suffix="")
    {
        // by http://www.manongjc.com/article/1319.html
        $pregRule = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.jpg|\.jpeg|\.png|\.gif]))[\'|\"].*?[\/]?>/";
        $content = preg_replace($pregRule, '<img src="'.$prefix.'${1}'.$suffix.'" style="max-width:100%">', $content);
        return $content;
    }

}
