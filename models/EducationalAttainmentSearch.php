<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EducationalAttainment;

/**
 * EducationalAttainmentSearch represents the model behind the search form of `app\models\EducationalAttainment`.
 */
class EducationalAttainmentSearch extends EducationalAttainment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year_get'], 'integer'],
            [['specialization', 'university', 'user_id','created_at', 'updated_at'], 'safe'],
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
        $query = EducationalAttainment::find();

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

        $query->joinWith('user0');  
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'year_get' => $this->year_get,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'specialization', $this->specialization])
            ->andFilterWhere(['like', 'user.name', $this->user_id])
            ->andFilterWhere(['like', 'university', $this->university]);

        return $dataProvider;
    }
}
