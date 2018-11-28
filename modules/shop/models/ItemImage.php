<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_item_image".
 *
 * @property string $id
 * @property int $item_id
 * @property int $type
 * @property string $image
 * @property string $alt
 * @property string $thumb
 *
 * @property Item $item
 */
class ItemImage extends \yii\db\ActiveRecord
{
    const TYPE_PHOTO = 1;
    const TYPE_PLAN = 2;
    const TYPE_READY = 3;
    const TYPE_FILE = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_item_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'type'], 'integer'],
            [['alt'], 'string', 'max' => 250],
            [['image', 'thumb'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'item_id' => 'Товар',
            'type'    => 'Тип',
            'image'   => 'Файл',
            'thumb'   => 'Thumb',
            'alt'     => 'Подпись',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
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
        $thumb = \common\models\Image::cropImage($this->image, $width, $height, true, 30);
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
        return \common\models\Image::thumbImage($this->image, $maxSize, $clone, $quality);
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
        return \common\models\Image::cropImage($this->image, $width, $height, $clone, $quality);
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
        return $this->thumb ?? $this->image;
    }
}
