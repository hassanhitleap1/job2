<?php

namespace app\models;


use yii\data\ActiveDataProvider;
use app\models\Users;


/**
 * RequastJobSearch represents the model behind the search form of `app\models\RequastJob`.
 */
class UsersSearch extends Users
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'agree', 'phone',  'name_of_jobs_id','expected_salary',"gender", "year_of_experience", "action_user","first_payment"], 'integer'],
            [['name', 'certificates', 'experience','area' ,'nationality', 'governorate','category_id','subscribe_date','note','priorities'], 'safe'],
        ];
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
    
        $query = Users::find();
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
           
        $query->where(['type' => User::FORM_APPLAY_USER]);
        $query->orwhere(['type' => User::NORMAL_USER]);
    
        $query->joinWith('nationality0');
        $query->joinWith('governorate0');  
        $query->joinWith('category0');
        $query->joinWith('area0');
       // $query->joinWith('specialtie');
        $query->joinWith('nameOfjob');
        //$query->leftJoin('vedio_user', 'vedio_user.user_id = user.id');
        
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'agree' => $this->agree,
            'phone' => $this->phone,
            "gender"=>$this->gender,
            "action_user"=> $this->action_user,
            "year_of_experience"=>$this->year_of_experience,
            "first_payment"=>$this->first_payment,
            'expected_salary' => $this->expected_salary,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'certificates', $this->certificates])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'priorities', $this->priorities])
            ->andFilterWhere(['like', 'area.name_ar', $this->area])
            ->andFilterWhere(['=', 'vedio_user.name_of_jobs_id', $this->name_of_jobs_id])
            ->andFilterWhere(['like', 'nationality.name_ar', $this->nationality])
            ->andFilterWhere(['like', 'governorate.name_ar', $this->governorate])
            ->andFilterWhere(['like', 'categories.name_ar', $this->category_id])
            ->andFilterWhere(['>=', 'subscribe_date', $this->subscribe_date])
          ;
        $query->orderBy([
            'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending      
        ]);

        return $dataProvider;
    }
}
