<?php

namespace common\models;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property string $email
 * @property string $phone
 * @property string $text
 * @property string $file
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 * @property int $type
 * @property int $partner_id
 * @property int $accept
 */
class Request extends \yii\db\ActiveRecord
{
    const PAGE_CONTACT = 1;
    const PAGE_OTHER = 2;
    const PAGE_CALCULATION = 3;
    const PAGE_PARTNER = 4;
    const PAGE_API_CONS = 5;
    const PAGE_API_CALC = 6;

    const TYPES = [
        self::PAGE_CONTACT     => 'Контактная форма',
        self::PAGE_OTHER       => 'Консультация',
        self::PAGE_CALCULATION => 'Запрос на смету',
        self::PAGE_PARTNER     => 'Запрос на партнерство',
        self::PAGE_API_CONS    => 'Консультация по апи',
        self::PAGE_API_CALC    => 'Запрос на смету по апи',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (!$this->created_at) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        $this->updated_at = date('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'name', 'contact'], 'required'],
            [['text'], 'string', 'max' => 2000],
            [['file'], 'file', 'extensions' => 'png, jpg, gif, pdf, xls, xlsx, doc, docx, odt, zip, rar, 7z'],
            [['type', 'partner_id'], 'integer'],
            [['accept'], 'compare', 'compareValue' => 1, 'message' => 'Необходимо подтвердить согласие на обработку данных'],
            [['name', 'contact', 'phone', 'url'], 'string', 'max' => 255],
            [['email'], 'email']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'name'       => 'Имя',
            'contact'    => 'Контакты',
            'email'      => 'Email',
            'phone'      => 'Телефон',
            'text'       => 'Ваш вопрос',
            'file'       => 'Файл',
            'type'       => 'Тип',
            'partner_id' => 'Партнер',
            'accept'     => 'Согласие на обработку',
        ];
    }
}
