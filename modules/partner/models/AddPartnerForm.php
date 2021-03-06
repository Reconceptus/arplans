<?php


namespace modules\partner\models;


use common\models\Config;
use common\models\Profile;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Class AddPartnerForm
 * @package modules\partner\models
 * @property string $email
 * @property string $fio
 * @property string $name
 * @property string $phone
 * @property string $site
 */
class AddPartnerForm extends Model
{
    public $email;
    public $fio;
    public $name;
    public $phone;
    public $site;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'site'], 'trim'],
            [['email', 'phone', 'site', 'fio', 'name'], 'required'],
            ['email', 'email'],
            [['email', 'name', 'fio', 'phone', 'site'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с этим email уже зарегистрирован.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'  => 'Название фирмы',
            'email' => 'Email',
            'fio'   => 'ФИО',
            'phone' => 'Телефон',
            'site'  => 'Сайт',
        ];
    }


    /**
     * @return Partner|null
     * @throws \yii\base\Exception
     */
    public function add()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $user = new User();
            $profile = new Profile();
            $partner = new Partner();
            $password = Yii::$app->security->generateRandomString(10);
            $user->username = $this->email;
            $user->email = $this->email;
            $user->status = User::STATUS_ACTIVE;
            $user->access_token = Yii::$app->security->generateRandomString(15);
            $user->setPassword($password);
            $user->generateAuthKey();
            if ($user->save()) {
                $userRole = Yii::$app->authManager->getRole('user');
                Yii::$app->authManager->assign($userRole, $user->getId());
                $profile->user_id = $user->id;
                $profile->fio = $this->fio;
                $profile->phone = $this->phone;
                if ($profile->save()) {
                    $partner->url = $this->site;
                    $partner->name = $this->name;
                    $partner->agent_id = $user->id;
                    $partner->is_active = Partner::IS_ACTIVE;
                    $partner->email = $this->email;
                    $partner->send_notify = 0;
                    if ($partner->save()) {
                        Yii::$app->mailer->compose('partner-reg', ['partner' => $partner, 'user' => $user, 'password' => $password])
                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                            ->setTo($user->email)
                            ->setBcc(Config::getValue('requestEmail'))
                            ->setSubject('Вы зарегистрированы как партнер на сайте ' . Yii::$app->request->getHostInfo())
                            ->send();
                        $transaction->commit();
                        return $partner;
                    }
                }
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
        return null;
    }
}