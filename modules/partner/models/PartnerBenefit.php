<?php

namespace modules\partner\models;

/**
 * This is the model class for table "partner_benefit".
 *
 * @property int $id
 * @property int $partner_id
 * @property string $name
 * @property string $text
 *
 * @property Partner $partner
 */
class PartnerBenefit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partner_benefit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 500],
            [['partner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Partner::className(), 'targetAttribute' => ['partner_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'partner_id' => 'Партнер',
            'name'       => 'Заголовок',
            'text'       => 'Текст',
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
