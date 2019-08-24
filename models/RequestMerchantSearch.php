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
            [['id', 'salary_from', 'salary_to', 'agree_from', 'agree_to',  'number_of_houer'], 'integer'],
            [['job_title', 'desc_job', 'area', 'note','nationality', 'user_id','governorate'], 'safe'],
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

        $query->joinWith('nationality0');
        $query->joinWith('governorate0');  
        $query->joinWith('user0');  

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'salary_from' => $this->salary_from,
            'salary_to' => $this->salary_to,
            'agree_from' => $this->agree_from,
            'agree_to' => $this->agree_to,
            //'governorate' => $this->governorate,
            'number_of_houer' => $this->number_of_houer,
            // 'nationality' => $this->nationality,
            // 'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'job_title', $this->job_title])
            ->andFilterWhere(['like', 'desc_job', $this->desc_job])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'nationality.name_ar', $this->nationality])
            ->andFilterWhere(['like', 'governorate.name_ar', $this->governorate])
            ->andFilterWhere(['like', 'user.name', $this->user_id])
            ->andFilterWhere(['like', 'note', $this->note]);
        $query->orderBy([
            'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending      
        ]);
        return $dataProvider;
    }
}
