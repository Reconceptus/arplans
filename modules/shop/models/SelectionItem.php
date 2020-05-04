<?php

namespace modules\shop\models;

/**
 * This is the model class for table "selection_item".
 *
 * @property int $id
 * @property int $selection_id
 * @property int $item_id Item
 * @property int $status
 *
 * @property Item $item
 * @property Selection $selection
 */
class SelectionItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'selection_item';
    }


    public const STATUS_AUTO_ADDED = 0;
    public const STATUS_SELF_ADDED = 1;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['selection_id', 'item_id', 'status'], 'integer'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['selection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Selection::className(), 'targetAttribute' => ['selection_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'selection_id' => 'Selection ID',
            'item_id'      => 'Item ID',
            'status'       => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelection()
    {
        return $this->hasOne(Selection::className(), ['id' => 'selection_id']);
    }
}
