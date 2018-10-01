<?php

namespace modules\partner\models;

use common\models\User;
use modules\shop\models\Category;

/**
 * This is the model class for table "partner".
 *
 * @property int               $id
 * @property int               $url
 * @property int               $agent_id
 *
 * @property User              $agent
 * @property PartnerCategory[] $partnerCategories
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'name'], 'string', 'max' => 255],
            ['agent_id', 'integer'],
            [['agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['agent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ID',
            'url'      => 'Url',
            'agent_id' => 'Agent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgent()
    {
        return $this->hasOne(User::className(), ['id' => 'agent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('partner_category', ['partner_id' => 'id']);
    }
}
