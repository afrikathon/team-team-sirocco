<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Offers;

/**
 * OffersSearch represents the model behind the search form of `frontend\models\Offers`.
 */
class OffersSearch extends Offers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'recruiter_id', 'talent_id', 'created_at', 'updated_at'], 'integer'],
            [['offer_title', 'recruiter_name', 'recruiter_email', 'talent_name', 'description', 'talent_email', 'talent_response', 'status'], 'safe'],
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
        //$query = Offers::find();
        if(Yii::$app->user->identity->account_type=="talent") {
            $query = Offers::find()->where(["talent_id"=>Yii::$app->user->identity->id]);
        }else{
            $query = Offers::find()->where(["recruiter_id"=>Yii::$app->user->identity->id]);
        }

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
            'recruiter_id' => $this->recruiter_id,
            'talent_id' => $this->talent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'offer_title', $this->offer_title])
            ->andFilterWhere(['like', 'recruiter_name', $this->recruiter_name])
            ->andFilterWhere(['like', 'recruiter_email', $this->recruiter_email])
            ->andFilterWhere(['like', 'talent_name', $this->talent_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'talent_email', $this->talent_email])
            ->andFilterWhere(['like', 'talent_response', $this->talent_response])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
