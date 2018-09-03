<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 29.08.2018
 * Time: 16:24
 */

namespace modules\shop\widgets\cart;


use modules\shop\models\Cart as CartModel;
use modules\shop\models\Favorite;
use Yii;
use yii\base\Widget;

class Cart extends Widget
{
    public $viewName = 'index';

    public function run()
    {
        $cart = CartModel::setGuid();

        if (!Yii::$app->user->isGuest && $cart) {
            Yii::$app->db->createCommand('UPDATE shop_cart SET user_id=' . Yii::$app->user->id . ' WHERE guid="' . $cart . '" AND user_id IS null')->execute();
            Yii::$app->db->createCommand('UPDATE shop_cart SET guid="' . $cart . '" WHERE user_id=' . Yii::$app->user->id)->execute();
        }

        $cartCount = CartModel::countGoods($cart);
        $favoriteCount = 0;
        if (!Yii::$app->user->isGuest) {
            $favoriteCount = Favorite::find()->where(['user_id' => Yii::$app->user->id])->count();
        }
        $content = $this->render($this->viewName, ['cartCount' => $cartCount, 'favoriteCount' => $favoriteCount]);
        return $content;
    }
}