<?php

namespace modules\content\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "content_block".
 *
 * @property integer $id
 * @property string  $slug
 * @property string  $text
 * @property string  $name
 * @property string  $page
 * @property string  $page_title
 * @property string  $page_url
 * @property string  $language
 */
class ContentBlock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug'], 'unique'],
            [['slug'], 'required'],
            [['text'], 'string'],
            [['slug', 'page', 'page_title', 'page_url', 'name'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'page'       => 'Код страницы',
            'page_title' => 'Страница',
            'slug'       => 'Slug',
            'text'       => 'Текст',
            'language'   => 'Язык',
        ];
    }

    /**
     * @param $slug
     * @return ContentBlock|null|ActiveRecord
     */
    public static function getOption(string $slug)
    {
        $model = self::find()->where(['slug' => $slug])->one();
        return $model;
    }

    /**
     * @param $slug
     * @return null|string
     */
    public static function getValue(string $slug)
    {
        $model = self::getOption($slug);
        return $model ? $model->text : null;
    }
}
