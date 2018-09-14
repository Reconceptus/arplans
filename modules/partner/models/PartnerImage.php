<?php

namespace modules\partner\models;

/**
 * This is the model class for table "partner_image".
 *
 * @property int $id
 * @property int $partner_id
 * @property string $file
 * @property string $thumb
 * @property int $sort
 *
 * @property Partner $partner
 */
class PartnerImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partner_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_id', 'sort'], 'integer'],
            [['file', 'thumb'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['partner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Partner::className(), 'targetAttribute' => ['partner_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_id' => 'Партнер',
            'file' => 'Фото',
            'thumb' => 'Thumb',
            'sort' => 'Сортировка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(Partner::className(), ['id' => 'partner_id']);
    }
}
