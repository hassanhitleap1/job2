<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RequastJob;
use Carbon\Carbon;

/**
 * RequastJobSearch represents the model behind the search form of `app\models\RequastJob`.
 */
class RequastJobSearch extends RequastJob
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'agree', 'phone',  'expected_salary',"gender","first_payment"], 'integer'],
            [['name', 'certificates', 'experience','area' ,'nationality', 'governorate','category_id','subscribe_date','note','priorities'], 'safe'],
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
    
        $query = RequastJob::find();
        // print_r($query->createCommand()->queryAll() );
        // exit;
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
        
            //
        $subQuery=CountSendSms::find()->where('count > 3')->select('user_id');
        //
        $query->where(['type' => User::NORMAL_USER]);
        $query->andWhere(['pay_service' => User::PAY_SERVICE]);
    //     $query->andWhere(['and',
    //         ['not in', 'user.id', $subQuery],
    //         ['>=','created_at',Carbon::now("Asia/Amman")->subDays(30)->toDateString()]
    //    ]);
        $query->joinWith('nationality0');
        $query->joinWith('governorate0');  
        $query->joinWith('category0');  

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'agree' => $this->agree,
            'phone' => $this->phone,
            "gender"=>$this->gender,
            "first_payment"=>$this->first_payment,
            // 'nationality' => $this->nationality,
            // 'governorate' => $this->governorate,
            'expected_salary' => $this->expected_salary,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'certificates', $this->certificates])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'priorities', $this->priorities])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'nationality.name_ar', $this->nationality])
            ->andFilterWhere(['like', 'governorate.name_ar', $this->governorate])
            ->andFilterWhere(['like', 'categories.name_ar', $this->category_id])
            ->andFilterWhere(['>=', 'subscribe_date', $this->subscribe_date])
            ->andFilterWhere(['like', 'note', $this->note]);
        $query->orderBy([
            'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending      
        ]);

        return $dataProvider;
    }
}
