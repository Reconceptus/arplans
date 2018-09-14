<?php

namespace common\models;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $last_name
 * @property string $first_name
 * @property string $patronymic
 * @property string $fio
 * @property string $image
 * @property string $phone
 * @property string $country
 * @property string $city
 * @property string $address
 * @property int $type
 * @property string $organization
 * @property string $position
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'type'], 'integer'],
            [['image'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['last_name', 'first_name', 'patronymic', 'fio', 'phone', 'country', 'city', 'address', 'organization', 'position'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'user_id'      => 'User ID',
            'last_name'    => 'Фамилия',
            'first_name'   => 'Имя',
            'patronymic'   => 'Отчество',
            'fio'          => 'ФИО',
            'image'        => 'Фото',
            'phone'        => 'Телефон',
            'country'      => 'Страна',
            'city'         => 'Город',
            'address'      => 'Адрес',
            'type'         => 'Тип',
            'organization' => 'Организация',
            'position'     => 'Должность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
