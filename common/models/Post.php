<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $text
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property int $author_id
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 * @property int $on_main
 * @property int $sort
 * @property int $to_menu
 * @property string $short_description
 * @property int $on_main_top
 *
 * @property Comment[] $comments
 * @property User $author
 * @property PostTag[] $postTags
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_NOT_PUBLISHED = 0;

    public static function findActive()
    {
        return new PostQuery(get_called_class());
    }

    private $_url;

    public function getUrl()
    {
        if ($this->_url === null)
            $this->_url = Url::to('/blog/' . $this->slug);
        return $this->_url;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug'], 'unique'],
            [['slug', 'name', 'text', 'author_id'], 'required'],
            [['text'], 'string'],
            [['author_id', 'status', 'sort'], 'integer'],
            [['on_main_top', 'on_main', 'to_menu'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug', 'name', 'title', 'keywords', 'description', 'short_description'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['image'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'slug'              => 'Url',
            'name'              => 'Заголовок',
            'text'              => 'Текст',
            'title'             => 'Title',
            'keywords'          => 'Keywords',
            'description'       => 'Description',
            'short_description' => 'Краткое описание',
            'author_id'         => 'Автор',
            'image'             => 'Изображение',
            'created_at'        => 'Добавлено',
            'updated_at'        => 'Изменено',
            'status'            => 'Статус',
            'sort'              => 'Сортировка',
            'on_main'           => 'Вывести на главную',
            'on_main_top'       => 'В 3 статьи на главной',
            'to_menu'           => 'Вывести в футер',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->via('postTags');
    }

    /**
     * Возвращает массив с id тегов, которые прилеплены к посту
     * @return array
     */
    public function getTagIds()
    {
        $tags = [];
        foreach ($this->postTags as $postTag) {
            $tags[] = (int)$postTag->id;
        }
        return $tags;
    }

    /**
     * Обновляет теги на те, которые переданы
     * @param array $tagsArray
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function updateTags(array $tagsArray)
    {
        foreach ($tagsArray as $lang => $tags) {
            $tags = explode(',', $tags);
            foreach ($tags as $k => $tag) {
                $tags[$k] = trim($tag);
            }
            $existTags = ArrayHelper::map($this->getTags()->all(), 'name', 'id');
            foreach ($tags as $k => $tag) {
                if (array_key_exists($tag, $existTags)) {
                    unset($existTags[$tag]);
                    unset($tags[$k]);
                }
            }
            // В массиве остались только те теги, которые были удалены
            foreach ($existTags as $existTag) {
                PostTag::deleteTag($this->id, $existTag);
            }
            foreach ($tags as $addTag) {
                if ($addTag) {
                    Tag::addTag($this->id, $addTag, $lang);
                }
            }
        }
    }

    /**
     * Получаем соседние статьи
     * @param $currentId
     * @return array
     */
    public static function getNeighbors($currentId)
    {
        $records = self::find()->orderBy('id DESC')->all();

        foreach ($records as $i => $record) {
            if ($record->id == $currentId) {
                $next = isset($records[$i - 1]) ? $records[$i - 1]->slug : null;
                $prev = isset($records[$i + 1]) ? $records[$i + 1]->slug : null;
                break;
            }
        }
        return ['next' => $next ?? null, 'prev' => $prev ?? null];
    }
}

class PostQuery extends ActiveQuery
{
    public function active()
    {
        $this->andWhere(['status' => Post::STATUS_PUBLISHED]);
        return $this;
    }
}
