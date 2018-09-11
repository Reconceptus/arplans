<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_service_file".
 *
 * @property int $id
 * @property int $service_id
 * @property string $file
 * @property int $sort
 *
 * @property Service $service
 */
class ServiceFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_service_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'sort'], 'integer'],
            [['file'], 'file', 'extensions' => 'pdf, doc, docx'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Услуги',
            'file' => 'Файл',
            'sort' => 'Сортировка',
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
