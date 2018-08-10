<?php

namespace common\models;


use yii\db\ActiveQuery;

/**
 * This is the model class for table "post_tag".
 *
 * @property string $id
 * @property int $post_id
 * @property int $tag_id
 *
 * @property Tag $tag
 * @property Post $post
 */
class PostTag extends \yii\db\ActiveRecord
{
    public $exists;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'integer'],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'post_id' => 'Post ID',
            'tag_id'  => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @param int $postId
     * @param int $tagId
     * @return false|int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public static function deleteTag(int $postId, int $tagId)
    {
        return self::find()->where(['post_id' => $postId, 'tag_id' => $tagId])->one()->delete();
    }

    /**
     * Есть ли статьи с тегами
     * @return bool| ActiveQuery
     */
    public static function isExistsActiveTags()
    {
        $result = self::find()->alias('pt')
            ->innerJoin(Post::tableName() . ' p', 'pt.post_id = p.id')
            ->innerJoin(Tag::tableName() . ' t', 'pt.tag_id = t.id')
            ->where(['p.status' => Post::STATUS_PUBLISHED])
            ->andWhere(['t.language' => \Yii::$app->language])->count();
        return $result > 0;
    }
}
