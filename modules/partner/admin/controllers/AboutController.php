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
use modules\partner\models\AboutReady;
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
            if (isset($post['new-ready'])) {
                $newProjects = explode(':', $post['new-ready']);
                foreach ($newProjects as $newProject) {
                    if ($newProject) {
                        $project = new AboutReady();
                        $project->file = $newProject;
                        if (!$project->save()) {
                            throw new Exception('Ошибка сохранения проекта');
                        };
                    }
                }
            }
        }
        $readyProjects = AboutReady::find()->all();
        return $this->render('index', ['model' => $model, 'readyProjects' => $readyProjects]);
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

    /**
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteProject()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        if (intval($get['id'])) {
            $model = AboutReady::findOne(['id' => $get['id']]);
            if ($model) {
                $fileName = Yii::getAlias('@webroot') . $model->file;
                if (file_exists($fileName) && is_file($fileName)) {
                    unlink($fileName);
                }
                $model->delete();
            } else {
                return ['status' => 'fail', 'message' => 'Ошибка при удалении изображеия'];
            }
        } elseif (isset($get['file'])) {
            $fileName = Yii::getAlias('@webroot') . $get['file'];
            unlink($fileName);
        }
        return ['status' => 'success'];
    }
}