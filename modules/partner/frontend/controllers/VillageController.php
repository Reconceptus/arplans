<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\partner\frontend\controllers;

use modules\partner\models\Builder;
use modules\partner\models\Village;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class VillageController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $get = Yii::$app->request->get();
        $query = Village::getFilteredQuery($get);
        return $this->render('index', ['query' => $query]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView()
    {
        $slug = Yii::$app->request->get('slug');
        $model = Village::findOne(['slug' => $slug, 'is_active' => Builder::IS_ACTIVE, 'is_deleted' => Builder::IS_NOT_DELETED, 'no_page'=>Builder::IS_NOT_ACTIVE]);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $this->render('view', ['model' => $model]);
    }
}