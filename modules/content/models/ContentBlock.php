<?php

namespace modules\content\models;

/**
 * This is the model class for table "content_block".
 *
 * @property integer $id
 * @property string  $slug
 * @property string  $text
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
            [['slug', 'page', 'page_title'], 'string', 'max' => 255],
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
}
