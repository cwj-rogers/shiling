<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19 0019
 * Time: 下午 2:10
 */

namespace frontend\widgets;
use yii\db\Query;
use Yii;

class SideBox{
    function product(){
        //右侧推荐方案
        $sql1 = 'SELECT g.goods_id,g.goods_name,g.goods_thumb, g.goods_img, g.goods_sn ' .
            'FROM ecs_goods AS g '.
            'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND g.goods_id IN (1980,2250,3434,3433,3432,3437,3435,3431,2443,1902,1678) ';
        $vrres = Yii::$app->db_bw->createCommand($sql1)->queryAll();
    }
}