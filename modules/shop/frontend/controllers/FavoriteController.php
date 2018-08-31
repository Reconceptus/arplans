<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\shop\frontend\controllers;

use modules\shop\models\Favorite;
use modules\shop\models\Item;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class FavoriteController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            $query = Favorite::find()->alias('f')
                ->innerJoin(Item::tableName() . ' i', 'f.item_id=i.id')
                ->where(['f.user_id' => \Yii::$app->user->id, 'i.active' => Item::IS_ACTIVE, 'i.deleted' => Item::IS_NOT_DELETED]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query
            ]);
            return $this->render('index', ['dataProvider' => $dataProvider]);
        }
    }

    /**
     * Добавляем/удаляем товар в избранное
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
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
        } else if ($model && isset($get['fav']) && $get['fav'] === 'true') {
            $fav = true;
        } else if ($model && isset($get['fav']) && $get['fav'] === 'false') {
            $model->delete();
        }
        return ['fav' => $fav];
    }
}