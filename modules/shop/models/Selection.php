<?php

namespace modules\shop\models;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "selection".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $min_price
 * @property string $max_price
 * @property string $url
 * @property int $min_bedrooms
 * @property int $max_bedrooms
 * @property int $min_bathrooms
 * @property int $max_bathrooms
 * @property int $min_area
 * @property int $max_area
 * @property int $one_floor
 * @property int $two_floor
 * @property int $mansard
 * @property int $pedestal
 * @property int $cellar
 * @property int $garage
 * @property int $double_garage
 * @property int $tent
 * @property int $terrace
 * @property int $balcony
 * @property int $light2
 * @property int $pool
 * @property int $sauna
 * @property int $gas_boiler
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property SelectionItem[] $selectionItems
 * @property Item[] $items
 * @property Block[] $blocks
 * @property SelectionOption[] $options
 */
class Selection extends \yii\db\ActiveRecord
{
    public const STATUS_DISABLED = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;

    public const SELECT_ATTRIBUTES = [
        'one_floor', 'two_floor', 'gas_boiler', 'sauna', 'pool', 'light2', 'balcony',
        'terrace', 'tent', 'double_garage', 'garage', 'cellar', 'pedestal', 'mansard'
    ];

    public const STATUS_LIST = [
        self::STATUS_DISABLED => 'Disabled',
        self::STATUS_ACTIVE   => 'Active',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'selection';
    }

    private $_url;

    public function getUrl()
    {
        if ($this->_url === null) {
            $this->_url = Url::to('/shop/selection/'.$this->slug);
        }
        return $this->_url;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['min_price', 'max_price'], 'number'],
            [
                [
                    'min_bedrooms', 'max_bedrooms', 'min_bathrooms', 'max_bathrooms', 'min_area', 'max_area', 'one_floor', 'two_floor', 'mansard', 'pedestal',
                    'cellar', 'garage', 'double_garage', 'tent', 'terrace', 'balcony', 'light2', 'pool', 'sauna', 'gas_boiler', 'status'
                ], 'integer'
            ],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'name'          => 'Название',
            'slug'          => 'Url',
            'description'   => 'Описание',
            'min_price'     => 'Минимальная цена',
            'max_price'     => 'Максимальная цена',
            'min_bedrooms'  => 'Минимум комнат',
            'max_bedrooms'  => 'Максимум комнат',
            'min_bathrooms' => 'Минимум ванных',
            'max_bathrooms' => 'Максимум ванных',
            'min_area'      => 'Минимальная площадь',
            'max_area'      => 'Максимальная площадь',
            'one_floor'     => 'Один этаж',
            'two_floor'     => 'Два этажа',
            'mansard'       => 'Мансарда',
            'pedestal'      => 'Pedestal',
            'cellar'        => 'Подвал',
            'garage'        => 'Гараж',
            'double_garage' => 'Гараж на два авто',
            'tent'          => 'Навес',
            'terrace'       => 'Терраса',
            'balcony'       => 'Балкон',
            'light2'        => 'Второй свет',
            'pool'          => 'Бассейн',
            'sauna'         => 'Сауна',
            'gas_boiler'    => 'Газовая котельная',
            'status'        => 'Статус',
            'created_at'    => 'Добавлено',
            'updated_at'    => 'Изменено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelectionItems()
    {
        return $this->hasMany(SelectionItem::className(), ['selection_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])->via('selectionItems');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(SelectionOption::className(), ['selection_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockSelections()
    {
        return $this->hasMany(BlockSelection::className(), ['selection_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlocks()
    {
        return $this->hasMany(Block::className(), ['id' => 'block_id'])->via('blockSelections');
    }

    public function collect()
    {
        $query = Item::find()->alias('i')->where(['i.is_deleted' => 0]);
        foreach (self::SELECT_ATTRIBUTES as $attr) {
            if ($this->$attr) {
                $query->andWhere([$attr => 1]);
            }
        }
        /* спальни */
        if ($this->min_bedrooms > 0) {
            $query->andWhere(['>=', 'i.rooms', $this->min_bedrooms]);
        }
        if ($this->max_bedrooms > 0) {
            $query->andWhere(['<=', 'i.rooms', $this->max_bedrooms]);
        }
        /* ванны */
        if ($this->min_bathrooms > 0) {
            $query->andWhere(['>=', 'i.bathrooms', $this->min_bathrooms]);
        }
        if ($this->max_bathrooms > 0) {
            $query->andWhere(['<=', 'i.bathrooms', $this->max_bathrooms]);
        }
        /* площадь */
        if ($this->min_area > 0) {
            $query->andWhere(['>=', 'i.common_area', $this->min_area]);
        }
        if ($this->max_area > 0) {
            $query->andWhere(['<=', 'i.common_area', $this->max_area]);
        }
        /* цена */
        if ($this->min_price > 0) {
            $query->andWhere(['>=', 'i.price', $this->min_price]);
        }
        if ($this->max_price > 0) {
            $query->andWhere(['<=', 'i.price', $this->max_price]);
        }
        /* Фильтры */
        $options = $this->options;
        foreach ($options as $option) {
            if ($option->filter_item_id && $option->filter_id) {
                $query->innerJoin(ItemOption::tableName().' io_'.$option->id, 'io_'.$option->id.'.item_id=i.id')
                    ->andWhere(['io_'.$option->id.'.catalog_id' => $option->filter_id, 'io_'.$option->id.'.catalog_item_id' => $option->filter_item_id]);
            }
        }

        $models = $query->all();
        foreach ($models as $model) {
            /* @var $model Item */
            if (!SelectionItem::find()->where(['selection_id' => $this->id, 'item_id' => $model->id])->exists()) {
                $si = new SelectionItem();
                $si->selection_id = $this->id;
                $si->item_id = $model->id;
                $si->status = SelectionItem::STATUS_AUTO_ADDED;
                $si->save();
            }
        }
    }

    public static function collectAll()
    {
        $models = self::find()->where(['status' => self::STATUS_ACTIVE])->all();
        /* @var $models self[] */
        foreach ($models as $model) {
            $model->collect();
        }
    }

    /**
     * @param  int  $filter_id
     * @return CatalogItem|mixed|null
     */
    public function getSelectionOptionCatalogItem(int $filter_id)
    {
        if ($filter_id) {
            $so = SelectionOption::find()->where(['filter_id' => $filter_id, 'selection_id' => $this->id])->one();
            /* @var $so SelectionOption */
            if ($so) {
                return $so->filterItem;
            }
        }
        return null;
    }

    /**
     * @param $newBlocks
     */
    public function updateBlocks($newBlocks)
    {
        $oldBLocks = ArrayHelper::getColumn($this->blocks, 'id');
        $blocksToInsert = array_diff($newBlocks, $oldBLocks);
        $blocksToDelete = array_diff($oldBLocks, $newBlocks);
        BlockSelection::deleteAll(['and', ['selection_id' => $this->id], ['block_id' => $blocksToDelete]]);
        foreach ($blocksToInsert as $ins) {
            $blockCat = new BlockSelection(['selection_id' => $this->id, 'block_id' => $ins]);
            $blockCat->save();
        }
    }
}
