<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 * @property int $sort
 * @property string $language
 *
 * @property PostTag[] $postTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 6],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ID',
            'name'     => 'Name',
            'sort'     => 'Sort',
            'language' => 'Language',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->via('postTags');
    }

    /**
     * Если не существует соотношения поста и тега, то создается. Если тега нет, то он тоже создается
     * @param int $postId
     * @param string $tagName
     * @param string $lang
     * @return array|PostTag|null|\yii\db\ActiveRecord
     */
    public static function addTag(int $postId, string $tagName, string $lang)
    {
        $tagName = mb_strtolower($tagName);
        $model = self::find()->where(['name' => $tagName, 'language' => $lang])->one();
        if (!$model) {
            $model = new self();
            $model->name = $tagName;
            $model->language = $lang;
            $model->save();
        }
        $postTag = PostTag::find()->where(['tag_id' => $model->id, 'post_id' => $postId])->one();
        if (!$postTag) {
            $postTag = new PostTag();
            $postTag->post_id = $postId;
            $postTag->tag_id = $model->id;
            $postTag->save();
        }
        return $postTag;
    }
}
