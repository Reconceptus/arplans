<?php

namespace frontend\models;

use common\models\User;
use himiklab\yii2\recaptcha\ReCaptchaValidator3;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public const SCENARIO_NO_CAPTCHA = 'no_captcha';
    public $reCaptcha;
    public $email;
    public $password;
    public $is_referrer;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Пользователь с этим email уже зарегистрирован.'],
            ['is_referrer', 'boolean'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['reCaptcha'], ReCaptchaValidator3::className(), 'except' => self::SCENARIO_NO_CAPTCHA],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws \Exception
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->email;
        $user->email = $this->email;
        $user->status = User::STATUS_ACTIVE;
        if($this->is_referrer){
            $user->is_referrer = 1;
        }
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $inv = (int) Yii::$app->request->cookies->getValue('inv');
        if ($inv) {
            $user->referrer_id = $inv;
            Yii::$app->response->cookies->remove('inv');
        }
        if ($user->save()) {
            $userRole = Yii::$app->authManager->getRole('user');
            Yii::$app->authManager->assign($userRole, $user->getId());
            return $user;
        }
        return null;
    }
}
