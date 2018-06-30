<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WxActivitiesOrder;

/**
 * WxActivitiesOrderSearch represents the model behind the search form about `common\models\WxActivitiesOrder`.
 */
class WxActivitiesOrderSearch extends WxActivitiesOrder
{
    public $from_date;
    public $to_date;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ago_id', 'user_id', 'wg_id', 'ago_cut_number', 'ago_need_cut', 'ago_share_time', 'ago_share_kanjia', 'ago_status', 'ago_payment_method', 'ago_take_method', 'ago_return_call'], 'integer'],
            [['ago_order_sn', 'ago_province', 'ago_city', 'ago_exprice_time', 'ago_finish_date', 'created_time'], 'safe'],
            [['ago_cut_total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = WxActivitiesOrder::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'created_time'=>SORT_DESC//设置默认排序是create_time倒序
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /* 时间搜索 */
        if(isset($params['OrderSearch']['from_date']) && isset($params['OrderSearch']['to_date'])){
            $this->from_date = $params['OrderSearch']['from_date'];
            $this->to_date = $params['OrderSearch']['to_date'];
        }
        if($this->from_date !='' && $this->to_date != '') {
            $query->andFilterWhere(['between', 'create_time', strtotime($this->from_date), strtotime($this->to_date)]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ago_id' => $this->ago_id,
            'user_id' => $this->user_id,
            'wg_id' => $this->wg_id,
            'ago_cut_total' => $this->ago_cut_total,
            'ago_cut_number' => $this->ago_cut_number,
            'ago_need_cut' => $this->ago_need_cut,
            'ago_share_time' => $this->ago_share_time,
            'ago_share_kanjia' => $this->ago_share_kanjia,
            'ago_status' => $this->ago_status,
            'ago_payment_method' => $this->ago_payment_method,
            'ago_take_method' => $this->ago_take_method,
            'ago_return_call' => $this->ago_return_call,
            'ago_exprice_time' => $this->ago_exprice_time,
            'ago_finish_date' => $this->ago_finish_date,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'ago_order_sn', $this->ago_order_sn])
            ->andFilterWhere(['like', 'ago_province', $this->ago_province])
            ->andFilterWhere(['like', 'ago_city', $this->ago_city]);

        return $dataProvider;
    }

    public static function dropDown ($column, $value = null){
        $dropDownList = [
            "ago_status"=> [
                "1"=>"进行中",
                "2"=>"砍价成功",
                "3"=>"支付成功",
                "4"=>"活动过期"
            ],
        ];
        //根据具体值显示对应的值
        if ($value !== null){
            $columnData = array_key_exists($column, $dropDownList) ? $dropDownList[$column] : null;
            return array_key_exists($value, $columnData) ? $columnData[$value] : null;
        }else{
            //返回关联数组，用户下拉的filter实现
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : null;
        }
    }
}
