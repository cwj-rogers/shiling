<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WxGoods;

/**
 * WxGoodsSearch represents the model behind the search form about `common\models\WxGoods`.
 */
class WxGoodsSearch extends WxGoods
{
    public $from_date; // 搜索开始时间
    public $to_date; // 搜索结束时间

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wg_id', 'wg_number', 'wg_view', 'wg_finish_deal', 'wg_need_cut', 'wg_type', 'wg_status', 'wg_promote_time', 'wg_sort'], 'integer'],
            [['wg_name', 'wg_description', 'wg_content', 'wg_goods_album', 'created_time', 'updated_time'], 'safe'],
            [['wg_market_price'], 'number'],
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
        $query = WxGoods::find();

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
            'wg_id' => $this->wg_id,
            'wg_market_price' => $this->wg_market_price,
            'wg_number' => $this->wg_number,
            'wg_view' => $this->wg_view,
            'wg_finish_deal' => $this->wg_finish_deal,
            'wg_need_cut' => $this->wg_need_cut,
            'wg_type' => 1,
            'wg_status' => $this->wg_status,
            'wg_promote_time' => $this->wg_promote_time,
            'wg_sort' => $this->wg_sort,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'wg_name', $this->wg_name]);

        return $dataProvider;
    }

    public static function dropDown ($column, $value = null){
        $dropDownList = [
            "wg_status"=> [
                "1"=>"上架",
                "0"=>"下架",
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

    public static function id2name($id){
        $good = self::findOne($id);
        if (!empty($good)){
            $name = $good->wg_name;
            return explode(" ",$name)[0];
        }else{
            return null;
        }
    }

    public static function id2price($id){
        $good = self::findOne($id);
        if (!empty($good)){
            return $good->wg_market_price;
        }else{
            return null;
        }
    }
}
