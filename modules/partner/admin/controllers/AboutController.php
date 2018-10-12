<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 13.09.2018
 * Time: 17:35
 */

namespace modules\partner\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\partner\models\About;
use modules\partner\models\AboutBenefit;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Response;
use yii\web\UploadedFile;

class AboutController extends AdminController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class'        => AccessControl::className(),
            'denyCallback' => function ($rule, $action) {
                return $this->redirect('/');
            },
            'rules'        => [
                [
                    'actions' => [],
                    'allow'   => true,
                    'roles'   => [
                        'partner_about',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = About::getModel();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $logo = UploadedFile::getInstance($model, 'about_main_image');
            if ($logo && $logo->tempName) {
                $model->about_main_image = $logo;
                if ($model->validate(['about_main_image'])) {
                    $dir = Yii::getAlias('@webroot/uploads/village/item/');
                    FileHelper::createDirectory($dir . '/');
                    $fileName = 'image.' . $model->about_main_image->extension;
                    $model->about_main_image->saveAs($dir . '/' . $fileName);
                    $model->about_main_image = '/uploads/village/item/' . $fileName;
                } else {
                    var_dump($model->errors);
                }
            }
            if (!$model->about_main_image && isset($post['old_image'])) {
                $model->about_main_image = $post['old_image'];
            }
            $model->save();
            if (isset($post['new-benefits'])) {
                $newBenefits = explode('~', $post['new-benefits']);
                foreach ($newBenefits as $newBenefit) {
                    if ($newBenefit) {
                        $data = explode('|', $newBenefit);
                        $benefit = new AboutBenefit();
                        $benefit->name = $data[0];
                        $benefit->text = $data[1];
                        if (!$benefit->save()) {
                            throw new Exception('Ошибка сохранения');
                        };
                    }
                }
            }
        }
        return $this->render('index', ['model' => $model]);
    }

    /**
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteBenefit()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = intval(Yii::$app->request->get('id'));
        if ($id) {
            $model = AboutBenefit::findOne(['id' => $id]);
            if ($model) {
                $model->delete();
                return ['status' => 'success'];
            }
        }
        return ['status' => 'fail', 'message' => 'Ошибка при удалении'];
    }
}