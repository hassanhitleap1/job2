<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserMessageWhatsapp;

/**
 * UserMessageWhatsappSearch represents the model behind the search form of `app\models\UserMessageWhatsapp`.
 */
class UserMessageWhatsappSearch extends UserMessageWhatsapp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['test','user_id', 'marchent_id', 'created_at', 'updated_at'], 'safe'],
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
        $query = UserMessageWhatsapp::find();

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

       $query->joinWith('user0  as user');
       $query->joinWith('marchent0 as marchent');  

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'user_id' => $this->user_id,
            // 'marchent_id' => $this->marchent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'test', $this->test])
       ->andFilterWhere(['like', 'marchent0.name', $this->marchent_id])
        ->andFilterWhere(['like', 'user0.name', $this->user_id])
        ;

        return $dataProvider;
    }
}
