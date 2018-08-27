<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_item_image".
 *
 * @property string $id
 * @property int $item_id
 * @property int $type
 * @property string $image
 * @property string $thumb
 *
 * @property Item $item
 */
class ItemImage extends \yii\db\ActiveRecord
{
    const TYPE_PHOTO = 1;
    const TYPE_PLAN = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_item_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'type'], 'integer'],
            [['image', 'thumb'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'item_id' => 'Товар',
            'type'    => 'Тип',
            'image'   => 'Файл',
            'thumb'   => 'Thumb',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }
}
