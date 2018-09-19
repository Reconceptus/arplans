<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 13.09.2018
 * Time: 17:35
 */

namespace modules\partner\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\partner\models\Village;
use modules\partner\models\VillageBenefit;
use modules\partner\models\VillageImage;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class VillageController extends AdminController
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
                        'partner_village',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'image-upload' => [
                'class'            => 'vova07\imperavi\actions\UploadFileAction',
                'url'              => '/uploads/partner/post', // Directory URL address, where files are stored.
                'path'             => '@webroot/uploads/village/post', // Or absolute path to directory where files are stored.
                'translit'         => true,
                'validatorOptions' => [
                    'maxWidth'  => 1200,
                    'maxHeight' => 1000
                ],
            ],
            ''
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $query = Village::find()->where(['is_deleted' => Village::IS_NOT_DELETED]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }


    /**
     * Создание нового партнера
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Village();
        return $this->modify($model);
    }

    /**
     * Редактирование товара
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->modify($model);
    }

    /**
     * @param $model Village
     * @return string|Response
     */
    public function modify($model)
    {
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $logo = UploadedFile::getInstance($model, 'logo');
            if ($logo && $logo->tempName) {
                $model->logo = $logo;
                if ($model->validate(['logo'])) {
                    $dir = Yii::getAlias('@webroot/uploads/village/logo/');
                    FileHelper::createDirectory($dir . $model->id . '/');
                    $fileName = 'logo.' . $model->logo->extension;
                    $model->logo->saveAs($dir . $model->id . '/' . $fileName);
                    $model->logo = '/uploads/village/logo/' . $model->id . '/' . $fileName;
                } else {
                    var_dump($model->errors);
                }
            }
            if (!$model->logo && isset($model->oldAttributes['logo'])) {
                $model->logo = $model->oldAttributes['logo'];
            }
            $price = UploadedFile::getInstance($model, 'price_list');
            if ($price && $price->tempName) {
                $model->price_list = $price;
                if ($model->validate(['price_list'])) {
                    $dir = Yii::getAlias('@webroot/uploads/village/price/');
                    FileHelper::createDirectory($dir . $model->id . '/');
                    $fileName = 'pricelist.' . $model->price_list->extension;
                    $model->price_list->saveAs($dir . $model->id . '/' . $fileName);
                    $model->price_list = '/uploads/village/price/' . $model->id . '/' . $fileName;
                } else {
                    var_dump($model->errors);
                }
            }
            if (!$model->price_list && isset($model->oldAttributes['price_list'])) {
                $model->price_list = $model->oldAttributes['price_list'];
            }
            if ($model->save()) {

                if (isset($post['new-images'])) {
                    $newImages = explode(':', $post['new-images']);
                    foreach ($newImages as $newImage) {
                        if ($newImage) {
                            $image = new VillageImage();
                            $image->village_id = $model->id;
                            $image->file = $newImage;
                            if (!$image->save()) {
                                throw new Exception('Ошибка сохранения изображения');
                            };
                        }
                    }
                }
                if (isset($post['new-benefits'])) {
                    $newBenefits = explode('~', $post['new-benefits']);
                    foreach ($newBenefits as $newBenefit) {
                        if ($newBenefit) {
                            $data = explode('|', $newBenefit);
                            $benefit = new VillageBenefit();
                            $benefit->village_id = $model->id;
                            $benefit->name = $data[0];
                            $benefit->text = $data[1];
                            if (!$benefit->save()) {
                                throw new Exception('Ошибка сохранения');
                            };
                        }
                    }
                }
                if (!$model->image) {
                    $model->image_id = $model->images ? $model->images[0]->id : null;
                    $model->save();
                }
                Yii::$app->session->setFlash('success', 'Поселок добавлен успешно');
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка при добавлении поселка');
            }


            return $this->redirect(Url::to(['/admin/modules/partner/village/update', 'id' => $model->id]));
        }

        return $this->render('_form', [
            'model' => $model,
        ]);
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
            $model = VillageBenefit::findOne(['id' => $id]);
            if ($model) {
                $model->delete();
                return ['status' => 'success'];
            }
        }
        return ['status' => 'fail', 'message' => 'Ошибка при удалении'];
    }

    /**
     * Загрузка фото по ajax
     * @return array
     * @throws Exception
     */
    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (empty($_FILES['images'])) {
            return ['success' => 'fail', 'message' => 'Не найдены файлы для загрузки'];
        }

        $images = $_FILES['images'];
        $success = null;
        $paths = [];
        $blocks = [];
        $fullPaths = [];
        $fileNames = $images['name'];
        $dir = Yii::getAlias('@webroot/uploads/village/item/');
        $path = date('ymdHis') . '/';
        if (!is_dir($dir . $path)) {
            FileHelper::createDirectory($dir . $path);
        }

        for ($i = 0; $i < count($fileNames); $i++) {
            $fileName = str_replace(' ', '_', $fileNames[$i]);
            $target = $dir . $path . $fileName;
            if (move_uploaded_file($images['tmp_name'][$i], $target)) {
                $success = true;
                $paths[] = '/uploads/village/item/' . $path . $fileName;
                $fullPaths[] = $dir . $path . $fileName;
                $model = new VillageImage();
                $model->file = '/uploads/village/item/' . $path . $fileName;
                $blocks[] = $this->renderAjax('_image', ['model' => $model]);
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = ['status' => 'success', 'files' => $paths, 'type' => Yii::$app->request->post('type'), 'blocks' => $blocks];
        } elseif ($success === false) {
            $output = ['status' => 'fail', 'message' => 'Ошибка при загрузке файлов, обратитесь к разработчику'];
            foreach ($fullPaths as $file) {
                unlink($file);
            }
        } else {
            $output = ['status' => 'fail', 'message' => 'Файлы не были загружены.'];
        }

        return $output;
    }

    /**
     * Удаление картинки партнера через ajax
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        if (intval($get['id'])) {
            $model = VillageImage::findOne(['id' => $get['id']]);
            $item = Village::find()->where(['image_id' => $get['id']])->one();
            if ($model) {
                $fileName = Yii::getAlias('@webroot') . $model->file;
                if (file_exists($fileName) && is_file($fileName)) {
                    unlink($fileName);
                }
                $thumbName = Yii::getAlias('@webroot') . $model->thumb;
                if (file_exists($thumbName) && is_file($thumbName)) {
                    unlink($thumbName);
                }
                $model->delete();
                if ($item) {
                    $item->image_id = null;
                    $item->save();
                }
            } else {
                return ['status' => 'fail', 'message' => 'Ошибка при удалении изображеия'];
            }
        } elseif (isset($get['file'])) {
            $fileName = Yii::getAlias('@webroot') . $get['file'];
            unlink($fileName);
        }
        return ['status' => 'success'];
    }

    /**
     * Устанавливает через ajax основное фото для партнера
     * @return array
     */
    public function actionSetPreview()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->get('id');
        $model = VillageImage::findOne(['id' => $id]);
        if ($model) {
            $item = $model->village;
            if ($item) {
                $item->image_id = $model->id;
                if ($item->save()) {
                    return ['status' => 'success'];
                }
            }
        }
        return ['status' => 'fail'];
    }

    /**
     * @return Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionDelete()
    {
        $model = $this->findModel(Yii::$app->request->get('id'));
        $model->is_deleted = Village::IS_DELETED;
        if ($model->save()) {
            return $this->redirect(Yii::$app->request->get('back'));
        }
        throw new Exception('Ошибка при удалении партнера');
    }


    /**
     * @param $id
     * @return Village|null|ActiveRecord
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Village::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}