<?php

namespace modules\shop\models;

use common\models\User;
use yii\base\Exception;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ref_request".
 *
 * @property int $id
 * @property int $referrer_id
 * @property float $amount
 * @property int $status
 * @property string $info
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $referrer
 */
class RefRequest extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_COMPLETE = 1;
    const STATUS_DECLINE = 2;

    const STATUS_LIST = [
        self::STATUS_NEW      => 'Новый',
        self::STATUS_COMPLETE => 'Исполнена',
        self::STATUS_DECLINE  => 'Отклонена'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['referrer_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['amount', 'info', 'comment'], 'string', 'max' => 255],
            [['referrer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['referrer_id' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        $time = date('Y-m-d H:i:s');
        if ($this->isNewRecord) {
            $this->created_at = $time;
        }
        $this->updated_at = $time;
        if(array_key_exists('status', $this->oldAttributes)) {
            if ($this->oldAttributes['status'] != $this->status && $this->status == self::STATUS_COMPLETE) {
                $user = $this->referrer;
                if ($this->amount > $user->bonusRemnants) {
                    throw new Exception('Сумма к выводу больше суммы на счете');
                }
                $user->bonus_payed = floatval($this->amount) + floatval($user->bonus_payed);
                $user->save();
            }
        }
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'referrer_id' => 'Реферер',
            'amount'      => 'Сумма',
            'status'      => 'Статус',
            'info'        => 'Информация',
            'comment'     => 'Комментарий админа',
            'created_at'  => 'Создан',
            'updated_at'  => 'Изменен',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RefRequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RefRequestQuery(get_called_class());
    }

    /**
     * @return ActiveQuery
     */
    public function getReferrer()
    {
        return $this->hasOne(User::className(), ['id' => 'referrer_id']);
    }
}
