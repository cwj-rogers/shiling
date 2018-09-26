<?php
namespace backend\models\service;
use yii\db\Query;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/25 0025
 * Time: 下午 2:42
 */

class YhtService
{
    private $query;
    public function __construct()
    {
        $this->query = new Query();
    }

    /**
     * @return int|string
     */
    public function Stats(){
        // 1.合同总量 2.签约用户 3.管理员 4.归档合同
        try{
            $conTotal = $this->query->from("yii2_wx_yht_contract")->select("*")->where("`cont_is_del`=0")->count();
            $conTotalToday = $this->query->from("yii2_wx_yht_contract")->select("*")->where("`cont_is_del`=0")->andWhere(['between','cont_created_time',date('Y-m-d'),date('Y-m-d',strtotime("+1day"))])->count();
            $filingTotal = $this->query->from("yii2_wx_yht_contract")->select("*")->where("`cont_is_del`=0 and cont_is_filing=1")->count();
            $filingTotalToday = $this->query->from("yii2_wx_yht_contract")->select("*")->where("`cont_is_del`=0 and cont_is_filing=1")->andWhere(['between','cont_created_time',date('Y-m-d'),date('Y-m-d',strtotime("+1day"))])->count();

            $userTotal = $this->query->from("yii2_wx_yht_info")->select("COUNT(*)")->where(['yht_authority'=>3])->count();
            $userTotalToday = $this->query->from("yii2_wx_yht_info")->select("COUNT(*)")->where(['yht_authority'=>3])->andWhere(['between','yht_created_time',date('Y-m-d'),date('Y-m-d',strtotime("+1day"))])->count();
            $adminTotal = $this->query->from("yii2_wx_yht_info")->select("COUNT(*)")->where(['yht_authority'=>2])->count();
            $adminTotalToday = $this->query->from("yii2_wx_yht_info")->select("COUNT(*)")->where(['yht_authority'=>2])->andWhere(['between','yht_created_time',date('Y-m-d'),date('Y-m-d',strtotime("+1day"))])->count();
            $res = [
                'conTotal'=>[$conTotal,$conTotalToday],
                'filingTotal'=>[$filingTotal,$filingTotalToday],
                'userTotal'=>[$userTotal,$userTotalToday],
                'adminTotal'=>[$adminTotal,$adminTotalToday]
            ];
            return $res;
        }catch (\yii\db\Exception $e){
            return $e->getMessage();
        }
    }
}