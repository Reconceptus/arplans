<?php

namespace modules\partner\models;

use common\models\User;
use modules\shop\models\Category;

/**
 * This is the model class for table "partner".
 *
 * @property int $id
 * @property string $url
 * @property int $agent_id
 * @property int $is_active
 * @property int $is_deleted
 * @property int $send_notify
 * @property string $contract
 * @property string $contacts
 * @property string $email
 * @property string $name
 *
 * @property User $agent
 * @property PartnerCategory[] $partnerCategories
 */
class Partner extends \yii\db\ActiveRecord
{
    const IS_ACTIVE = 1;
    const IS_NOT_ACTIVE = 0;
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

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
            [['url', 'api_url', 'name', 'email', 'contacts', 'contract'], 'string', 'max' => 255],
            ['email', 'email'],
            ['agent_id', 'integer'],
            [['is_active', 'is_deleted', 'send_notify'], 'boolean'],
            [['agent_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['agent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'url'         => 'Сайт',
            'api_url'     => 'Url API',
            'name'        => 'Название',
            'email'       => 'Email для заявок',
            'contacts'    => 'Контакты',
            'contract'    => 'Номер договора',
            'agent_id'    => 'Представитель',
            'is_active'   => 'Активен',
            'send_notify' => 'Посылать уведомления о заявках партнеру',
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

    /**
     * @return array
     */
    public static function getUserList()
    {
        return Partner::find()->alias('p')
            ->select(['p.name', 'u.id'])
            ->innerJoin(User::tableName() . ' u', 'p.agent_id=u.id')
            ->where(['p.is_active' => Partner::IS_ACTIVE, 'p.is_deleted' => Partner::IS_NOT_DELETED])
            ->indexBy('id')
            ->column();
    }
}
