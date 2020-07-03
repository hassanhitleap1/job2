<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Merchant;

/**
 * MerchantSearch represents the model behind the search form of `app\models\Merchant`.
 */
class MerchantSearch extends Merchant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'phone'], 'integer'],
            [['governorate', 'name', 'area', 'note', 'name_company', 'location'], 'safe'],
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
        $query = Merchant::find();

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

        $query->andFilterWhere([
            'type' => User::MERCHANT_USER,
        ]);
        $query->joinWith('governorate0');
        $query->joinWith('area0'); 
        // grid filtering conditions
        $query->andFilterWhere([
            'phone' => $this->phone,
        ]);
 

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'area.name_ar', $this->area])
            ->andFilterWhere(['like', 'governorate.name_ar', $this->governorate])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'name_company', $this->name_company])
          ;

        $query->orderBy([
            'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending      
        ]);
        return $dataProvider;
    }
}
