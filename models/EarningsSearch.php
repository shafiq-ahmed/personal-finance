<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Earnings;

/**
 * EarningsSearch represents the model behind the search form of `app\models\Earnings`.
 */
class EarningsSearch extends Earnings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'source'], 'integer'],
            [['previousBalance', 'inflowAmount'], 'number'],
            [['inflowDescription', 'createdAt'], 'safe'],
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
        $query = Earnings::find();

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
            'source' => $this->source,
            'previousBalance' => $this->previousBalance,
            'inflowAmount' => $this->inflowAmount,
            'createdAt' => $this->createdAt,
        ]);

        $query->andFilterWhere(['like', 'inflowDescription', $this->inflowDescription]);

        return $dataProvider;
    }
}
