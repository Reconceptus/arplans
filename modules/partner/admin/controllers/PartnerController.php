<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 13.09.2018
 * Time: 17:35
 */

namespace modules\partner\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\partner\models\Partner;
use yii\data\ActiveDataProvider;

class PartnerController extends AdminController
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $query = Partner::find()->where(['is_deleted' => Partner::IS_NOT_DELETED]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}