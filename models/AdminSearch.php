<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Admin;

/**
 * AdminSearch represents the model behind the search form of `app\models\Admin`.
 */
class AdminSearch extends Admin
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'agree', 'nationality', 'governorate', 'expected_salary', 'type', 'gender', 'category_id', 'pay_service', 'work_tolerance', 'teamwork', 'work_permanently', 'communication_skills', 'verification_email', 'action_user'], 'integer'],
            [['username', 'name', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'phone', 'certificates', 'experience', 'area', 'note', 'name_company', 'auth_token', 'subscribe_date', 'avatar', 'affiliated_to', 'affiliated_with', 'interview_time', 'created_at', 'updated_at', 'verification_token', 'priorities', 'contract_path'], 'safe'],
            [['year_of_experience', 'first_payment'], 'number'],
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
        $query = Admin::find();

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
            'status' => $this->status,
            'agree' => $this->agree,
            'nationality' => $this->nationality,
            'governorate' => $this->governorate,
            'expected_salary' => $this->expected_salary,
            'type' => $this->type,
            'subscribe_date' => $this->subscribe_date,
            'gender' => $this->gender,
            'year_of_experience' => $this->year_of_experience,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category_id' => $this->category_id,
            'pay_service' => $this->pay_service,
            'first_payment' => $this->first_payment,
            'work_tolerance' => $this->work_tolerance,
            'teamwork' => $this->teamwork,
            'work_permanently' => $this->work_permanently,
            'communication_skills' => $this->communication_skills,
            'verification_email' => $this->verification_email,
            'action_user' => $this->action_user,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'certificates', $this->certificates])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'name_company', $this->name_company])
            ->andFilterWhere(['like', 'auth_token', $this->auth_token])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'affiliated_to', $this->affiliated_to])
            ->andFilterWhere(['like', 'affiliated_with', $this->affiliated_with])
            ->andFilterWhere(['like', 'interview_time', $this->interview_time])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'priorities', $this->priorities])
            ->andFilterWhere(['like', 'contract_path', $this->contract_path]);

        return $dataProvider;
    }
}
