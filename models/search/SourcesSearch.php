<?php

namespace app\models\search;

use app\models\Sources;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SourcesSearch represents the model behind the search form of `app\models\Sources`.
 */
class SourcesSearch extends Sources
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'isPrimary'], 'integer'],
            [['name'], 'safe'],
            [['currentBalance'], 'number'],
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
        $query = Sources::find();

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
            'isPrimary'=>$this->isPrimary
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['<=','currentBalance',$this->currentBalance]);

        return $dataProvider;
    }
}
