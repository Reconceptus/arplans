<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.08.2018
 * Time: 9:42
 */

namespace modules\shop\widgets\filters;


use modules\shop\models\Catalog;
use modules\shop\models\Item;
use yii\base\Widget;
use yii\db\Query;

class Filters extends Widget
{
    public $viewName = 'index';
    public $category;
    public $api = false;

    public function run()
    {
        $query = new Query();
        $query->distinct(true)
            ->select('shop_catalog.id')
            ->from('shop_catalog')
            ->innerJoin('shop_catalog_item', 'shop_catalog.id = shop_catalog_item.catalog_id')
            ->innerJoin('shop_item_option', 'shop_catalog.id = shop_item_option.catalog_id and shop_catalog_item.id = shop_item_option.catalog_item_id')
            ->innerJoin('shop_item', 'shop_item.id = shop_item_option.item_id and shop_item.category_id =' . $this->category->id)
            ->where(['shop_item.is_active' => Item::IS_ACTIVE])
            ->andWhere(['or', 'shop_catalog.category_id IS NULL', 'shop_catalog.category_id = ' . $this->category->id]);
        $ids = [-1];

        $dbIds = $query->createCommand()->queryAll();
        foreach ($dbIds as $id) {
            $ids[] = $id['id'];
        }

        $filters = Catalog::find()
            ->distinct(true)
            ->where(['filter' => 1])
            ->andWhere(['in', 'id', $dbIds])
            ->orderBy(['sort' => SORT_ASC])
            ->all();


        $content = $this->render(($this->api ? 'api'.DIRECTORY_SEPARATOR : '') . $this->viewName, [
            'filters'  => $filters,
            'category' => $this->category
        ]);
        return $content;
    }
}