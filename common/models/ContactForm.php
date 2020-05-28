<?php
namespace common\models;


use himiklab\yii2\recaptcha\ReCaptchaValidator2;

class ContactForm extends Request
{
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
            [['name', 'contact', 'region', 'phone', 'url'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['reCaptcha'], ReCaptchaValidator2::className(), 'except' => self::SCENARIO_NO_CAPTCHA],
        ];
    }
}