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
        if (isset(Yii::$app->request->cookies['cart'])) {
            $cart = Yii::$app->request->cookies['cart'];
        }
        if (!isset($cart)) {
            $cart = Yii::$app->security->generateRandomString();
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name'  => 'cart',
                'value' => $cart
            ]));
            Yii::$app->params['cart'] = $cart;
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