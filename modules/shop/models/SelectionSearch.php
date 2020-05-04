<?php

namespace modules\shop\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SelectionSearch represents the model behind the search form of `modules\shop\models\Selection`.
 */
class SelectionSearch extends Selection
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'id', 'min_bedrooms', 'max_bedrooms', 'min_bathrooms', 'max_bathrooms', 'min_area', 'max_area', 'one_floor', 'two_floor', 'mansard',
                    'pedestal', 'cellar', 'garage', 'double_garage', 'tent', 'terrace', 'balcony', 'light2', 'pool', 'sauna', 'gas_boiler', 'status'
                ], 'integer'
            ],
            [['name', 'slug', 'description', 'created_at', 'updated_at'], 'safe'],
            [['min_price', 'max_price'], 'number'],
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
     * @param  array  $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Selection::find();

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
            'id'            => $this->id,
            'min_price'     => $this->min_price,
            'max_price'     => $this->max_price,
            'min_bedrooms'  => $this->min_bedrooms,
            'max_bedrooms'  => $this->max_bedrooms,
            'min_bathrooms' => $this->min_bathrooms,
            'max_bathrooms' => $this->max_bathrooms,
            'min_area'      => $this->min_area,
            'max_area'      => $this->max_area,
            'one_floor'     => $this->one_floor,
            'two_floor'     => $this->two_floor,
            'mansard'       => $this->mansard,
            'pedestal'      => $this->pedestal,
            'cellar'        => $this->cellar,
            'garage'        => $this->garage,
            'double_garage' => $this->double_garage,
            'tent'          => $this->tent,
            'terrace'       => $this->terrace,
            'balcony'       => $this->balcony,
            'light2'        => $this->light2,
            'pool'          => $this->pool,
            'sauna'         => $this->sauna,
            'gas_boiler'    => $this->gas_boiler,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
