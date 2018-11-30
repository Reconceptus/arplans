<?php

namespace modules\partner\models;

/**
 * This is the model class for table "village_image".
 *
 * @property int $id
 * @property int $village_id
 * @property string $file
 * @property string $thumb
 * @property string $alt
 * @property int $sort
 *
 * @property Village $village
 */
class VillageImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'village_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['village_id', 'sort'], 'integer'],
            [['alt'], 'string', 'max' => 250],
            [['file', 'thumb'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['village_id'], 'exist', 'skipOnError' => true, 'targetClass' => Village::className(), 'targetAttribute' => ['village_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'village_id' => 'Поселок',
            'file'       => 'Фото',
            'thumb'      => 'Thumb',
            'sort'       => 'Сортировка',
            'alt'        => 'Подпись',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVillage()
    {
        return $this->hasOne(Village::className(), ['id' => 'village_id']);
    }

    /**
     * @param int $width
     * @param int $height
     * @return string|null
     */
    public function makeThumb(int $width = 0, int $height = 0)
    {
        $width = $width > 0 ? $width : \common\models\Image::getCropWidth();
        $height = $height > 0 ? $height : \common\models\Image::getCropHeight();
        $thumb = \common\models\Image::cropImage($this->file, $width, $height, true, 30);
        $this->thumb = $thumb;
        if ($this->save()) {
            return $this->thumb;
        }
        return null;
    }

    /**
     * @param int $maxSize
     * @param bool $clone
     * @param int $quality
     * @return string
     */
    public function resizeImage(int $maxSize, bool $clone = true, int $quality = 90)
    {
        return \common\models\Image::thumbImage($this->file, $maxSize, $clone, $quality);
    }

    /**
     * @param int $width
     * @param int $height
     * @param bool $clone
     * @param int $quality
     * @return string
     */
    public function cropImage(int $width, int $height, bool $clone = true, int $quality = 90)
    {
        return \common\models\Image::cropImage($this->file, $width, $height, $clone, $quality);
    }


    /**
     * @return string
     */
    public function getThumb()
    {
        if (!$this->thumb) {
            $width = \common\models\Image::getCropWidth();
            $height = \common\models\Image::getCropHeight();
            $this->makeThumb($width, $height);
        }
        return $this->thumb ?? $this->file;
    }
}
