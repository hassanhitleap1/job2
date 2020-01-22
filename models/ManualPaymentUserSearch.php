<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ManualPaymentUser;

/**
 * ManualPaymentUserSearch represents the model behind the search form of `app\models\ManualPaymentUser`.
 */
class ManualPaymentUserSearch extends ManualPaymentUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['amount','is_first_payment'], 'number'],
            [['created_at', 'updated_at','user_id'], 'safe'],
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
        $query = ManualPaymentUser::find();

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

        $query->joinWith('user');

        if(isset($_GET['user_id'])){
            $query->andWhere(['user_id'=>$_GET['user_id']]);
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'is_first_payment'=>$this->is_first_payment,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'user.name', $this->user_id]);
        return $dataProvider;
    }
}
