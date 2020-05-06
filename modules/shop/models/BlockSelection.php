<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_block_selection".
 *
 * @property int $id
 * @property int $block_id
 * @property int $selection_id
 *
 * @property Block $block
 * @property Selection $selection
 */
class BlockSelection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_block_selection';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['block_id', 'selection_id'], 'integer'],
            [['block_id'], 'exist', 'skipOnError' => true, 'targetClass' => Block::className(), 'targetAttribute' => ['block_id' => 'id']],
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
            'block_id'     => 'Block ID',
            'selection_id' => 'Selection ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(Block::className(), ['id' => 'block_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelection()
    {
        return $this->hasOne(Selection::className(), ['id' => 'selection_id']);
    }
}
