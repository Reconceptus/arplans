<?php

namespace common\models;

/**
 * This is the model class for table "config".
 *
 * @property int    $id
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
            'id'    => 'ID',
            'name'  => 'Название',
            'slug'  => 'Slug',
            'value' => 'Значение',
        ];
    }

    /**
     * @param $slug
     * @return Config|null
     */
    public static function getOption(string $slug)
    {
        $model = Config::findOne(['slug' => $slug]);
        return $model;
    }

    /**
     * @param $slug
     * @return null|string
     */
    public static function getValue(string $slug)
    {
        $model = self::getOption($slug);
        return $model ? $model->value : null;
    }

    /**
     * @param string $slug
     * @param string $value
     * @return Config|null
     */
    public static function setValue(string $slug, string $value)
    {
        $model = self::getOption($slug);
        $model->value = $value;
        if($model->save()){
            return $model;
        }
        return null;
    }
}
