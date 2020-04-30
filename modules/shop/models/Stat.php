<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_item_stat".
 *
 * @property int $id
 * @property int $views
 * @property int $purchases
 *
 * @property Item $item
 */
class Stat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_item_stat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['views', 'purchases'], 'integer'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'views'     => 'Просмотров',
            'purchases' => 'Покупок',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'id']);
    }
}
