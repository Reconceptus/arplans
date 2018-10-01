<?php

namespace modules\partner\models;

/**
 * This is the model class for table "builder_benefit".
 *
 * @property int $id
 * @property int $builder_id
 * @property string $name
 * @property string $text
 *
 * @property Builder $builder
 */
class BuilderBenefit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'builder_benefit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['builder_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 500],
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
            'name'       => 'Заголовок',
            'text'       => 'Текст',
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
