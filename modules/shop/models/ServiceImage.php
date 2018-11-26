<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_service_image".
 *
 * @property int $id
 * @property int $service_id
 * @property string $file
 * @property string $thumb
 * @property string $alt
 * @property int $sort
 *
 * @property Service $service
 */
class ServiceImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_service_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'sort'], 'integer'],
            [['alt'], 'string', 'max' => 250],
            [['file', 'thumb'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'service_id' => 'Услуга',
            'file'       => 'Фото',
            'thumb'      => 'Thumb',
            'sort'       => 'Сортировка',
            'alt'        => 'Подпись',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
