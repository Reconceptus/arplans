<?php

namespace common\helpers;


use modules\shop\models\Item;

class SitemapHelper
{
    /**
     * Generate sitemap
     */
    public static function sitemap()
    {
        $items = [];
        $models = \Yii::$app->params['siteMapModels'];
        if ($models) {
            foreach ($models as $class) {
                if ($class === 'modules\shop\models\Item') {
                    $items = array_merge($items, $class::find()->where(['is_active' => 1, 'is_deleted' => 0])->all());
                } else {
                    $items = array_merge($items, $class::find()->where(['status' => 1])->all());
                }
            }
        }
        $str = self::generate($items);
        file_put_contents(\Yii::getAlias('@frontend').'/web/sitemap.xml', $str);
    }

    /**
     * @param $items Item[]
     * @return string
     */
    public static function generate($items)
    {
        $host = \Yii::$app->params['front'];
        $str = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($items as $item) {
            $str .= "<url>
            <loc>".$host.$item->getUrl()."</loc>
            <lastmod>".date(DATE_W3C, strtotime($item->updated_at))."</lastmod>
            <changefreq>weekly</changefreq>
            </url>";
        }
        $str .= '</urlset>';
        return $str;
    }
}