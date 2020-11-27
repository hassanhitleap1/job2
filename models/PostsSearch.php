<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Posts;
use Yii;

/**
 * PostsSearch represents the model behind the search form of `app\models\Posts`.
 */
class PostsSearch extends Posts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'accept', 'show_number'], 'integer'],
            [['title', 'body', 'area_id','country_id','region_id','created_at', 'updated_at'], 'safe'],
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
        $query = Posts::find();

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

        if(User::is_admin_advertiser()){
            $query->where(['user_id'=>Yii::$app->user->id]);   
        }
        $query->joinWith('country');  
        $query->joinWith('region');
        $query->joinWith('area');  

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'accept' => $this->accept,
            'show_number' => $this->show_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
        ->andFilterWhere(['like', 'countries.name_ar', $this->country_id])
        ->andFilterWhere(['like', 'regions.name_ar', $this->region_id])
        ->andFilterWhere(['like', 'area.name_ar', $this->area_id])
            ->andFilterWhere(['like', 'body', $this->body]);

            $query->orderBy([
                'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending      
            ]);
        return $dataProvider;
    }
}
