<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Quotes;

/**
 * Quotessearch represents the model behind the search form of `frontend\models\Quotes`.
 */
class Quotessearch extends Quotes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['customer_id', 'customer_name', 'description', 'insurance_type', 'insurance_company', 'insurance_company_id', 'feedback', 'amount', 'upload', 'created_at'], 'safe'],
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
        $query = Quotes::find();

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'customer_id', $this->customer_id])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'insurance_type', $this->insurance_type])
            ->andFilterWhere(['like', 'insurance_company', $this->insurance_company])
            ->andFilterWhere(['like', 'insurance_company_id', $this->insurance_company_id])
            ->andFilterWhere(['like', 'feedback', $this->feedback])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'upload', $this->upload]);

        return $dataProvider;
    }
}
