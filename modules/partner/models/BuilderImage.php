<?php

namespace modules\partner\models;

/**
 * This is the model class for table "builder_image".
 *
 * @property int $id
 * @property int $builder_id
 * @property string $file
 * @property string $thumb
 * @property string $alt
 * @property int $sort
 *
 * @property Builder $builder
 */
class BuilderImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'builder_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['builder_id', 'sort'], 'integer'],
            [['alt'], 'string'],
            [['file', 'thumb'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['builder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Builder::className(), 'targetAttribute' => ['builder_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'builder_id' => 'Застройщик',
            'file'       => 'Фото',
            'thumb'      => 'Thumb',
            'alt'        => 'Подпись',
            'sort'       => 'Сортировка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilder()
    {
        return $this->hasOne(Builder::className(), ['id' => 'builder_id']);
    }
}
