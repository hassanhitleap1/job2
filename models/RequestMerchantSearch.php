<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RequestMerchant;

/**
 * RequestMerchantSearch represents the model behind the search form of `app\models\RequestMerchant`.
 */
class RequestMerchantSearch extends RequestMerchant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'phone', 'avg_agree', 'governorate', 'avg_salary', 'number_of_houer', 'note'], 'integer'],
            [['name', 'name_company', 'job_title', 'desc_job', 'area'], 'safe'],
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
        $query = RequestMerchant::find();

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
            'phone' => $this->phone,
            'avg_agree' => $this->avg_agree,
            'governorate' => $this->governorate,
            'avg_salary' => $this->avg_salary,
            'number_of_houer' => $this->number_of_houer,
            'note' => $this->note,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'name_company', $this->name_company])
            ->andFilterWhere(['like', 'job_title', $this->job_title])
            ->andFilterWhere(['like', 'desc_job', $this->desc_job])
            ->andFilterWhere(['like', 'area', $this->area]);

        return $dataProvider;
    }
}
