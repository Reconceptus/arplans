<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace frontend\controllers;

use common\models\Page;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PageController extends Controller
{

    public function actionIndex()
    {
        return $this->redirect('/');
    }

    public function actionView()
    {
        $slug = Yii::$app->request->get('slug');
        $model = Page::find()->where(['slug' => $slug])->one();
        if (!$model) {
            throw new NotFoundHttpException('Page not found');
        }
        return $this->render('view', ['model' => $model]);
    }
}