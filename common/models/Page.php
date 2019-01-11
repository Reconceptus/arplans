<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\helpers\Url;

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

    public static function findActive()
    {
        return new PageQuery(get_called_class());
    }

    private $_url;

    public function getUrl()
    {
        if ($this->_url === null)
            $this->_url = Url::to('/' . $this->slug);
        return $this->_url;
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
            'image'       => 'Изображение',
            'name'        => 'Название',
            'text'        => 'Текст',
            'title'       => 'Заголовок (сео)',
            'keywords'    => 'Keywords (сео)',
            'description' => 'Описание (сео)',
            'created_at'  => 'Created At',
            'updated_at'  => 'Updated At',
        ];
    }
}

class PageQuery extends ActiveQuery
{
    public function active()
    {
        return $this;
    }
}