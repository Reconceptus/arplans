<?php

namespace modules\partner\models;

/**
 * This is the model class for table "about_ready".
 *
 * @property int $id
 * @property string $name
 * @property string $file
 */
class AboutReady extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about_ready';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'file'], 'string', 'max' => 255],
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
            'file' => 'File',
        ];
    }
}
