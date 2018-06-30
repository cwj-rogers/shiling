<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WxUser;

/**
 * WxUserSearch represents the model behind the search form about `common\models\WxUser`.
 */
class WxUserSearch extends WxUser
{
    public $from_date;
    public $to_date;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'sex'], 'integer'],
            [['open_id', 'username', 'image', 'mobile', 'province', 'city', 'reg_ip', 'reg_time', 'update_time'], 'safe'],
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
        $query = WxUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'user_id' => $this->user_id,
            'status' => $this->status,
            'sex' => $this->sex,
            'reg_time' => $this->reg_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'open_id', $this->open_id])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'reg_ip', $this->reg_ip]);

        return $dataProvider;
    }

    public static function id2name($id){
        $user = self::findOne($id);
        return !empty($user)? $user->username:null;
    }

    public static function dropDown ($column, $value = null){
        $dropDownList = [
            "status"=> [
                "0"=>"禁止",
                "1"=>"正常",
            ],
            "sex"=> [
                "1"=>"男",
                "2"=>"女",
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
