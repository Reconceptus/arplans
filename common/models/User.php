<?php

namespace common\models;

use modules\partner\models\Partner;
use modules\shop\models\Favorite;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string  $username
 * @property string  $password_hash
 * @property string  $password_reset_token
 * @property string  $email
 * @property string  $role
 * @property string  $auth_key
 * @property string  $access_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string  $password write-only password
 * @property Profile $profile
 * @property Partner $partner
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'role'], 'string', 'max'=>255],
            [['username', 'email', 'status'], 'required'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status'               => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    public static function getStatuses()
    {
        return [
            self::STATUS_DELETED => 'Disabled',
            self::STATUS_ACTIVE  => 'Active'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(Partner::className(), ['agent_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery|array
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::className(), ['user_id' => 'id'])->all();
    }

    /**
     * @return array
     */
    public function getFavoriteIds()
    {
        $favorites = $this->getFavorites();
        return ArrayHelper::map($favorites, 'item_id', 'id');
    }

    /**
     * Создание пользователя
     * @param $email
     * @param $password
     * @param $fio
     * @param $phone
     * @param $country
     * @param $city
     * @param $address
     * @return User
     */
    public static function createUser($email, $password, $fio, $phone, $country, $city, $address, $last_name = '', $first_name = '', $patronymic = '')
    {
        $user = new self();
        $user->email = $email;
        $user->username = $email;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->status = 10;
        if ($user->save()) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->fio = Html::encode($fio);
            $profile->phone = Html::encode($phone);
            $profile->country = Html::encode($country);
            $profile->city = Html::encode($city);
            $profile->address = Html::encode($address);
            $profile->last_name = Html::encode($last_name);
            $profile->first_name = Html::encode($first_name);
            $profile->patronymic = Html::encode($patronymic);
            if ($profile->save()) {
                return $user;
            }
        }
        return null;
    }

    public static function sendRegLetter($user)
    {
        Yii::$app->mailer->compose('registration', ['model' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($user->email)
            ->setSubject('Вы зарегистрированы на сайте ' . Yii::$app->name)
            ->send();
    }

    /**
     * @return array
     */
    public static function getAuthors()
    {
        $authors = User::find()->alias('u')->select(['p.fio', 'u.id'])
            ->innerJoin(Profile::tableName() . ' p', 'u.id = p.user_id')
            ->where(['in', 'u.role', ['admin', 'manager']])->indexBy('id')->column();
        return $authors;
    }

    /**
     * Получаем список всех ролей (кроме гостя)
     * @return array
     */
    public static function getAccessTypes() {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $result = [];
        foreach($roles as $name=>$role){
            if($name === 'guest')
                continue;
            $result[$name] = $role->description;
        }

        return $result;
    }
}
