<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Reports;

/**
 * Reportssearch represents the model behind the search form of `frontend\models\Reports`.
 */
class Reportssearch extends Reports
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['insurance_type', 'description', 'submitted_by', 'report_reference', 'customer_id', 'customer_name', 'company_id', 'claim_id', 'status', 'created_at'], 'safe'],
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
        $query = Reports::find();

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

        $query->andFilterWhere(['like', 'insurance_type', $this->insurance_type])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'submitted_by', $this->submitted_by])
            ->andFilterWhere(['like', 'report_reference', $this->report_reference])
            ->andFilterWhere(['like', 'customer_id', $this->customer_id])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'company_id', $this->company_id])
            ->andFilterWhere(['like', 'claim_id', $this->claim_id])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
