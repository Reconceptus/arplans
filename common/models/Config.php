<?php

namespace common\models;

/**
 * This is the model class for table "config".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $value
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'value' => 'Value',
        ];
    }

    /**
     * @param $slug
     * @return Config|null
     */
    public static function getOption($slug)
    {
        $model = Config::findOne(['slug' => $slug]);
        return $model;
    }

    /**
     * @param $slug
     * @return null|string
     */
    public static function getValue($slug)
    {
        $model = self::getOption($slug);
        return $model ? $model->value : null;
    }
}
