<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserMarchent;

/**
 * UserMarchentSearch represents the model behind the search form of `app\models\UserMarchent`.
 */
class UserMarchentSearch extends UserMarchent
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'school_id'], 'integer'],
            [['username', 'name', 'phone', 'name_company'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = UserMarchent::find();

        // add conditions that should always apply here
        $query->where(['type'=>User::MERCHANT_USER]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
       
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

     

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,          
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'name_company', $this->name_company]);
            
          
        return $dataProvider;
    }
}
