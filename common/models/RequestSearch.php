<?php


namespace common\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class RequestSearch extends Request
{
    public function rules(): array
    {
        return [
            [['id', 'type', 'partner_id'], 'integer'],
            [['name', 'email', 'contact', 'phone', 'text', 'seo_description', 'region'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }


    public function search($params)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'      => $this->id,
            'type'    => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        $d = $query->createCommand()->rawSql;
        return $dataProvider;
    }
}