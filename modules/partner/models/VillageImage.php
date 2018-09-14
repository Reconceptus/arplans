<?php

namespace modules\partner\models;

/**
 * This is the model class for table "village_image".
 *
 * @property int $id
 * @property int $village_id
 * @property string $file
 * @property string $thumb
 * @property int $sort
 *
 * @property Village $village
 */
class VillageImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'village_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['village_id', 'sort'], 'integer'],
            [['file', 'thumb'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => Village::className(), 'targetAttribute' => ['village_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'village_id' => 'Поселок',
            'file' => 'Фото',
            'thumb' => 'Thumb',
            'sort' => 'Сортировка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVillage()
    {
        return $this->hasOne(Village::className(), ['id' => 'village_id']);
    }
}
