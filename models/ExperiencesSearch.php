<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Experiences;

/**
 * ExperiencesSearch represents the model behind the search form of `app\models\Experiences`.
 */
class ExperiencesSearch extends Experiences
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'month_from_exp', 'year_from_exp', 'month_to_exp', 'year_to_exp'], 'integer'],
            [['job_title', 'facility_name', 'created_at', 'updated_at'], 'safe'],
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
        $query = Experiences::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'month_from_exp' => $this->month_from_exp,
            'year_from_exp' => $this->year_from_exp,
            'month_to_exp' => $this->month_to_exp,
            'year_to_exp' => $this->year_to_exp,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'job_title', $this->job_title])
            ->andFilterWhere(['like', 'facility_name', $this->facility_name]);

        return $dataProvider;
    }
}
