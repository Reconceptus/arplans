<?php

namespace modules\shop\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "shop_promocode".
 *
 * @property int $id
 * @property string $code
 * @property int $fixed_discount
 * @property double $percent_discount
 * @property int $min_amount
 * @property int $number_of_uses
 * @property int $used
 * @property int $status
 * @property string $text
 * @property string $start_date Первый день действия
 * @property string $end_date Последний день действия
 */
class Promocode extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;

    const STATUS_LIST = [
        self::STATUS_DISABLED => 'Неактивен',
        self::STATUS_ACTIVE   => 'Aктивен'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_promocode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date', 'number_of_uses', 'code'], 'required'],
            [['code'], 'string', 'length' => [4, 100]],
            [['end_date'], 'validateDate'],
            [['fixed_discount', 'percent_discount'], 'validateDiscount'],
            [['fixed_discount', 'min_amount', 'number_of_uses', 'used', 'status'], 'integer'],
            [['percent_discount'], 'number'],
            [['text'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['code'], 'string', 'max' => 100],
        ];
    }

    public function validateDiscount($attribute, $params)
    {
        if ($this->percent_discount && $this->fixed_discount) {
            $this->addError($attribute, 'Должен быть задан только один тип скидки - в процентах или рублях');
        } elseif (!$this->percent_discount && !$this->fixed_discount) {
            $this->addError($attribute, 'Должен быть задан хотя бы один тип скидки');
        }
    }

    public function validateDate($attribute, $params)
    {
        if (strtotime($this->start_date) > strtotime($this->end_date)) {
            $this->addError($attribute, 'Дата начала действия промокода должна быть меньше чем дата окончания');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'               => 'ID',
            'code'             => 'Код',
            'fixed_discount'   => 'Скидка в рублях',
            'percent_discount' => 'Скидка в процентах',
            'min_amount'       => 'Минимальная сумма для применения',
            'number_of_uses'   => 'Лимит',
            'used'             => 'Использовано раз',
            'text'             => 'Текст',
            'status'           => 'Статус',
            'start_date'       => 'Первый день действия',
            'end_date'         => 'Последний день действия',
        ];
    }
}
