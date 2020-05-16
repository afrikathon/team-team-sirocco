<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `frontend\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['full_name', 'display_picture', 'points', 'job_preference', 'career_level', 'years_of_experience', 'location', 'skills', 'cv_url', 'linkedIn_url', 'other_links', 'status'], 'safe'],
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
        $query = Profile::find()->orderBy(['points'=>SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
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
            'user_id' => $this->user_id,//Yii::$app->user->identity->id
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'display_picture', $this->display_picture])
            ->andFilterWhere(['like', 'points', $this->points])
            ->andFilterWhere(['like', 'job_preference', $this->job_preference])
            ->andFilterWhere(['like', 'career_level', $this->career_level])
            ->andFilterWhere(['like', 'years_of_experience', $this->years_of_experience])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'skills', $this->skills])
            ->andFilterWhere(['like', 'cv_url', $this->cv_url])
            ->andFilterWhere(['like', 'linkedIn_url', $this->linkedIn_url])
            ->andFilterWhere(['like', 'other_links', $this->other_links])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
