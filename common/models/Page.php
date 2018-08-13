<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $slug
 * @property string $image
 * @property string $name
 * @property string $text
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug', 'name', 'title', 'keywords', 'description'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'slug'        => 'Slug',
            'image'       => 'Image',
            'name'        => 'Name',
            'text'        => 'Text',
            'title'       => 'Title',
            'keywords'    => 'Keywords',
            'description' => 'Description',
            'created_at'  => 'Created At',
            'updated_at'  => 'Updated At',
        ];
    }
}
