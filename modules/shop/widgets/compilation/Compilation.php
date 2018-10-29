<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:24
 */

namespace modules\shop\widgets\compilation;


use modules\shop\models\Item;
use Yii;
use yii\base\Widget;

class Compilation extends Widget
{
    public $viewName = 'index';
    public $limit = 8;
    public $limitMobile = 4;
    public $showMobile = false;

    public function run()
    {
        if (!Yii::$app->user->isGuest) {
            $favorites = Yii::$app->user->identity->getFavoriteIds();
        }else{
            $favorites = [];
        }
        $models['new'] = Item::find()->where(['is_new' => Item::IS_NEW])->limit($this->limit)->orderBy(['created_at'=>SORT_DESC])->all();
        $models['discount'] = Item::find()->where(['>', 'discount', 0])->limit($this->limit)->orderBy(['created_at'=>SORT_DESC])->all();
        $models['free'] = Item::find()->where(['or', ['price' => 0.00], ['is', 'price', null]])->limit($this->limit)->orderBy(['created_at'=>SORT_DESC])->all();
        $content = $this->render($this->viewName, ['models' => $models, 'favorites' => $favorites]);
        if ($this->showMobile) {
            $content .= $this->render('mobile', ['models' => array_chunk($models, $this->limitMobile), 'favorites' => $favorites]);
        }
        return $content;
    }
}