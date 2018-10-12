<?php

namespace modules\partner\models;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string $author_name
 * @property string $author_email
 * @property string $author_status
 * @property string $text
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['author_name', 'author_email', 'author_status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_name' => 'Author Name',
            'author_email' => 'Author Email',
            'author_status' => 'Author Status',
            'text' => 'Text',
        ];
    }
}
