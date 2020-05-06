<?php
namespace modules\partner\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\partner\models\Collaboration;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class CollaborationController extends AdminController
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
     * @throws Exception
     * @throws \yii\db\Exception
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionIndex()
    {
        $model = Collaboration::getModel();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $logo1 = UploadedFile::getInstance($model, 'collaboration_image_1');
            if ($logo1 && $logo1->tempName) {
                $model->collaboration_image_1 = $logo1;
                if ($model->validate(['collaboration_image_1'])) {
                    $dir = Yii::getAlias('@webroot/uploads/village/item/collab/');
                    FileHelper::createDirectory($dir . '/');
                    $fileName = 'image1.' . $model->collaboration_image_1->extension;
                    $model->collaboration_image_1->saveAs($dir . '/' . $fileName);
                    $model->collaboration_image_1 = '/uploads/village/item/collab/' . $fileName;
                }
            }
            if (!$model->collaboration_image_1 && isset($post['old_collaboration_image_1'])) {
                $model->collaboration_image_1 = $post['old_collaboration_image_1'];
            }

            $logo2 = UploadedFile::getInstance($model, 'collaboration_image_2');
            if ($logo2 && $logo2->tempName) {
                $model->collaboration_image_2 = $logo2;
                if ($model->validate(['collaboration_image_2'])) {
                    $dir = Yii::getAlias('@webroot/uploads/village/item/collab/');
                    FileHelper::createDirectory($dir . '/');
                    $fileName = 'image2.' . $model->collaboration_image_2->extension;
                    $model->collaboration_image_2->saveAs($dir . '/' . $fileName);
                    $model->collaboration_image_2 = '/uploads/village/item/collab/' . $fileName;
                }
            }
            if (!$model->collaboration_image_2 && isset($post['old_collaboration_image_2'])) {
                $model->collaboration_image_2 = $post['old_collaboration_image_2'];
            }

            $logo3 = UploadedFile::getInstance($model, 'collaboration_image_3');
            if ($logo3 && $logo3->tempName) {
                $model->collaboration_image_3 = $logo3;
                if ($model->validate(['collaboration_image_3'])) {
                    $dir = Yii::getAlias('@webroot/uploads/village/item/collab/');
                    FileHelper::createDirectory($dir . '/');
                    $fileName = 'image3.' . $model->collaboration_image_3->extension;
                    $model->collaboration_image_3->saveAs($dir . '/' . $fileName);
                    $model->collaboration_image_3 = '/uploads/village/item/collab/' . $fileName;
                }
            }
            if (!$model->collaboration_image_3 && isset($post['old_collaboration_image_3'])) {
                $model->collaboration_image_3 = $post['old_collaboration_image_3'];
            }
            $model->save();
        }
        return $this->render('index', ['model' => $model]);
    }
}