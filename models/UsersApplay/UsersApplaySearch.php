<?php

namespace app\models\UsersApplay;

use app\models\FavoriteUsers;
use app\models\PostApply;
use app\models\User;
use yii\data\ActiveDataProvider;
use app\models\Users;
use app\models\VedioUser;
use Yii;

/**
 * RequastJobSearch represents the model behind the search form of `app\models\RequastJob`.
 */
class UsersApplaySearch extends UsersApplay
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'agree', 'phone', 'post_id','name_of_jobs_id','favorite','area','expected_salary',"gender", "year_of_experience", "action_user","first_payment"], 'integer'],
            [['name', 'certificates', 'is_upload','experience' ,'nationality', 'governorate','category_id','subscribe_date','note','priorities'], 'safe'],
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
    
        $query = UsersApplay::find();
    
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
        $query->joinWith('vedio');
       // $query->joinWith('specialtie');
        $query->joinWith('nameOfjob');
        //$query->leftJoin('vedio_user', 'vedio_user.user_id = user.id');
       $area=(isset($_GET['area']))?$_GET['area']:null;
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'agree' => $this->agree,
            'phone' => $this->phone,
            "gender"=>$this->gender,
            "action_user"=> $this->action_user,
            "area"=>$area,
            "year_of_experience"=>$this->year_of_experience,
            "first_payment"=>$this->first_payment,
            'expected_salary' => $this->expected_salary,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'certificates', $this->certificates])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'priorities', $this->priorities])
            // ->andFilterWhere(['like', 'area.name_ar', $this->area])
            ->andFilterWhere(['=', 'vedio_user.name_of_jobs_id', $this->name_of_jobs_id])
            ->andFilterWhere(['like', 'nationality.name_ar', $this->nationality])
            ->andFilterWhere(['like', 'governorate.name_ar', $this->governorate])
            ->andFilterWhere(['like', 'categories.name_ar', $this->category_id])
            ->andFilterWhere(['>=', 'subscribe_date', $this->subscribe_date])
          ;

          $subQuery = PostApply::find()->join('posts', 'posts.id = post_apply.post_id')->select('post_apply.user_id')
            ->where(['user_id'=>Yii::$app->user->id]);

        if($this->is_upload != null){
            $subQuery = VedioUser::find()->select('user_id');
            if($this->is_upload==1){
                $query->andWhere(['in', 'user.id', $subQuery]);
            }else{
                $query->andWhere(['not in', 'user.id', $subQuery]);
            }
        }


        if($this->favorite != null){
            $subQuery = FavoriteUsers::find()->select('user_id')->where(['merchant_id'=>Yii::$app->user->identity->id]);
            if($this->favorite==1){
                $query->andWhere(['in', 'user.id', $subQuery]);
            }else{
                $query->andWhere(['not in', 'user.id', $subQuery]); 
            }
        }


        $query->orderBy([
            'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending      
        ]);

        return $dataProvider;
    }
}
