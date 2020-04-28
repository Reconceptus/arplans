<?php

namespace modules\shop\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PromocodeSearch represents the model behind the search form of `modules\shop\models\Promocode`.
 */
class PromocodeSearch extends Promocode
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fixed_discount', 'min_amount', 'number_of_uses', 'used'], 'integer'],
            [['code', 'text', 'start_date', 'end_date'], 'safe'],
            [['percent_discount'], 'number'],
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
        $query = Promocode::find();

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
            'fixed_discount' => $this->fixed_discount,
            'percent_discount' => $this->percent_discount,
            'min_amount' => $this->min_amount,
            'number_of_uses' => $this->number_of_uses,
            'used' => $this->used,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
