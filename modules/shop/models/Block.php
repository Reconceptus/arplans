<?php

namespace modules\shop\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shop_block".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $seo_title
 * @property string $seo_description
 * @property string $slug Url
 * @property string $image Картинка
 * @property int $status Статус
 * @property int $sort Сортировка
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BlockSelection[] $blockSelections
 * @property Selection[] $selections
 */
class Block extends ActiveRecord
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_DISABLED = 0;

    public const STATUS_LIST = [
        self::STATUS_ACTIVE   => 'Активна',
        self::STATUS_DISABLED => 'Отключена'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'shop_block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['status', 'sort'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description', 'seo_title', 'seo_description', 'slug', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id'              => 'ID',
            'name'            => 'Name',
            'description'     => 'Description',
            'seo_title'       => 'Seo Title',
            'seo_description' => 'Seo Description',
            'slug'            => 'Slug',
            'image'           => 'Image',
            'status'          => 'Status',
            'sort'            => 'Sort',
            'created_at'      => 'Created At',
            'updated_at'      => 'Updated At',
        ];
    }

    /**
     * @return Block[]|null
     */
    public static function all()
    {
        return Yii::$app->cache->getOrSet('activeBlocks', function () {
            return Block::find()->where(['status' => Block::STATUS_ACTIVE])->all();
        }, 60 * 60);
    }

    /**
     * @return ActiveQuery
     */
    public function getBlockSelections()
    {
        return $this->hasMany(BlockSelection::className(), ['block_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSelections()
    {
        return $this->hasMany(Selection::className(), ['id' => 'selection_id'])->via('blockSelections');
    }
}
