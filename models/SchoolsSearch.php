<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Schools;

/**
 * SchoolsSearch represents the model behind the search form of `app\models\Schools`.
 */
class SchoolsSearch extends Schools
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name',  'details', 'director_word', 'discounts_form', 'map', 'brochure', 'contact_information'], 'safe'],
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
        $query = Schools::find();

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
            
        ]);
        //'details', 'director_word', 'discounts_form', 'map', 'brochure', 'contact_information'

        $query->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'director_word', $this->director_word])
        ->andFilterWhere(['like', 'discounts_form', $this->discounts_form])
        ->andFilterWhere(['like', 'map', $this->map])
        ->andFilterWhere(['like', 'brochure', $this->brochure])
        ->andFilterWhere(['like', 'brochure', $this->brochure])
        ->andFilterWhere(['like', 'contact_information', $this->contact_information]);

        return $dataProvider;
    }
}
