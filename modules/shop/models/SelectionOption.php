<?php

namespace modules\shop\models;

/**
 * This is the model class for table "selection_option".
 *
 * @property int $id
 * @property int $selection_id Selection
 * @property int $filter_id Filter
 * @property int $filter_item_id Filter Item
 *
 * @property Catalog $filter
 * @property CatalogItem $filterItem
 * @property Selection $selection
 */
class SelectionOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'selection_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['selection_id', 'filter_id', 'filter_item_id'], 'integer'],
            [['filter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catalog::className(), 'targetAttribute' => ['filter_id' => 'id']],
            [['filter_item_id'], 'exist', 'skipOnError'     => true, 'targetClass' => CatalogItem::className(),
                                          'targetAttribute' => ['filter_item_id' => 'id']
            ],
            [['selection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Selection::className(), 'targetAttribute' => ['selection_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'             => 'ID',
            'selection_id'   => 'Selection ID',
            'filter_id'      => 'Filter ID',
            'filter_item_id' => 'Filter Item ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilter()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'filter_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilterItem()
    {
        return $this->hasOne(CatalogItem::className(), ['id' => 'filter_item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelection()
    {
        return $this->hasOne(Selection::className(), ['id' => 'selection_id']);
    }
}
