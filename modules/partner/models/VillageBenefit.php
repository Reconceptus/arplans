<?php

namespace modules\partner\models;

/**
 * This is the model class for table "village_benefit".
 *
 * @property int $id
 * @property int $village_id
 * @property string $name
 * @property string $text
 *
 * @property Village $village
 */
class VillageBenefit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'village_benefit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['village_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 500],
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
            'name' => 'Заголовок',
            'text' => 'Текст',
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
