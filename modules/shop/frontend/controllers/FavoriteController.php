<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\shop\frontend\controllers;

use modules\shop\models\Favorite;
use yii\web\Controller;
use yii\web\Response;

class FavoriteController extends Controller
{
    /**
     * Добавляем/удаляем товар в избранное
     * @return array
     */
    public function actionAdd()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $get = \Yii::$app->request->get();
        $model = Favorite::find()->where(['item_id' => intval($get['id']), 'user_id' => \Yii::$app->user->id])->one();
        $fav = false;
        if (!$model && isset($get['fav']) && $get['fav'] === 'true') {
            $model = new Favorite();
            $model->item_id = intval($get['id']);
            $model->user_id = \Yii::$app->user->id;
            if ($model->save()) {
                $fav = true;
            }
        } else if($model && isset($get['fav']) && $get['fav'] === 'true') {
            $fav = true;
        }else if($model && isset($get['fav']) && $get['fav']=== 'false'){
            $model->delete();
        }
        return ['fav' => $fav];
    }
}