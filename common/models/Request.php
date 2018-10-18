<?php

namespace common\models;

/**
 * This is the model class for table "request".
 *
 * @property int    $id
 * @property string $name
 * @property string $contact
 * @property string $email
 * @property string $phone
 * @property string $text
 * @property string $file
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 * @property int    $type
 * @property int    $accept
 */
class Request extends \yii\db\ActiveRecord
{
    const PAGE_CONTACT = 1;
    const PAGE_OTHER = 2;

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
            [['text'], 'string'],
            [['file'], 'file', 'extensions' => 'png, jpg, gif, pdf, xls, xlsx, doc, docx, odt, zip, rar, 7z'],
            [['type'], 'integer'],
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
            'id'      => 'ID',
            'name'    => 'Имя',
            'contact' => 'Контакты',
            'email'   => 'Email',
            'phone'   => 'Телефон',
            'text'    => 'Ваш вопрос',
            'file'    => 'Файл',
            'type'    => 'Тип',
            'accept'  => 'Согласие на обработку',
        ];
    }
}
