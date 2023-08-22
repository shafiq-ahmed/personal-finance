<?php

namespace app\models\search;

use app\models\Expense;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ExpenseSearch represents the model behind the search form of `app\models\Expense`.
 */
class ExpenseSearch extends Expense
{
    /**
     * {@inheritdoc}
     */


    public function rules()
    {
        return [
            [['id','source',  'createdAt', 'isPaid'], 'integer'],
            [['name', 'month', 'expenseDate'], 'safe'],
            [['amount'], 'number'],
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
        $query = Expense::find()->joinWith('sourceModel');


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
            'amount' => $this->amount,
            'expenseDate' => $this->expenseDate,
            'createdAt' => $this->createdAt,
            'isPaid' => $this->isPaid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'month', $this->month]);


        return $dataProvider;
    }
}
