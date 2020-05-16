<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Jobs;

/**
 * Jobssearch represents the model behind the search form of `frontend\models\Jobs`.
 */
class Jobssearch extends Jobs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['job_description', 'job_type', 'job_location', 'job_id', 'posted_by', 'assigned_to', 'status', 'created_at'], 'safe'],
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
        $phone = Yii::$app->user->identity->phone;
        $query = Jobs::find()->where("posted_by != $phone");

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'job_description', $this->job_description])
            ->andFilterWhere(['like', 'job_type', $this->job_type])
            ->andFilterWhere(['like', 'job_location', $this->job_location])
            ->andFilterWhere(['like', 'job_id', $this->job_id])
            ->andFilterWhere(['like', 'posted_by', $this->posted_by])
            ->andFilterWhere(['like', 'assigned_to', $this->assigned_to])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public function search2($params)
    {
        $query = Jobs::find()->where(["posted_by"=>Yii::$app->user->identity->phone]);

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'job_description', $this->job_description])
            ->andFilterWhere(['like', 'job_type', $this->job_type])
            ->andFilterWhere(['like', 'job_location', $this->job_location])
            ->andFilterWhere(['like', 'job_id', $this->job_id])
            ->andFilterWhere(['like', 'posted_by', $this->posted_by])
            ->andFilterWhere(['like', 'assigned_to', $this->assigned_to])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public function search3($params)
    {
        $query = Jobs::find();

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'job_description', $this->job_description])
            ->andFilterWhere(['like', 'job_type', $this->job_type])
            ->andFilterWhere(['like', 'job_location', $this->job_location])
            ->andFilterWhere(['like', 'job_id', $this->job_id])
            ->andFilterWhere(['like', 'posted_by', $this->posted_by])
            ->andFilterWhere(['like', 'assigned_to', $this->assigned_to])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }


    public function search4($params)
    {
        $query = Jobs::find()->where(["assigned_to"=>Yii::$app->user->identity->phone]);

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'job_description', $this->job_description])
            ->andFilterWhere(['like', 'job_type', $this->job_type])
            ->andFilterWhere(['like', 'job_location', $this->job_location])
            ->andFilterWhere(['like', 'job_id', $this->job_id])
            ->andFilterWhere(['like', 'posted_by', $this->posted_by])
            ->andFilterWhere(['like', 'assigned_to', $this->assigned_to])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
