<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Payout;

/**
 * Payoutsearch represents the model behind the search form of `frontend\models\Payout`.
 */
class Payoutsearch extends Payout
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'amount', 'payout_attempt'], 'integer'],
            [['status', 'confirm_token', 'recipient_code', 'request_time', 'paid_time', 'reference', 'account_reference'], 'safe'],
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
        $query = Payout::find();

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
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'request_time' => $this->request_time,
            'paid_time' => $this->paid_time,
            'payout_attempt' => $this->payout_attempt,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'confirm_token', $this->confirm_token])
            ->andFilterWhere(['like', 'recipient_code', $this->recipient_code])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'account_reference', $this->account_reference]);

        return $dataProvider;
    }
}
