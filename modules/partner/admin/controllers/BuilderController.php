<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 13.09.2018
 * Time: 17:35
 */

namespace modules\partner\admin\controllers;


use common\models\Translit;
use common\models\User;
use modules\admin\controllers\AdminController;
use modules\partner\models\Builder;
use modules\partner\models\BuilderBenefit;
use modules\partner\models\BuilderImage;
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

class BuilderController extends AdminController
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
                        'partner_builder',
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
                'url'              => '/uploads/builder/post', // Directory URL address, where files are stored.
                'path'             => '@webroot/uploads/builder/post', // Or absolute path to directory where files are stored.
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
        $query = Builder::find()->where(['is_deleted' => Builder::IS_NOT_DELETED]);
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
        $model = new Builder();
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
     * @param $model Builder
     * @return string|Response
     */
    public function modify($model)
    {
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if (!$model->slug) {
                $model->slug = Translit::encodestring($model->name);
            }
            $logo = UploadedFile::getInstance($model, 'logo');
            if ($logo && $logo->tempName) {
                $model->logo = $logo;
                if ($model->validate(['logo'])) {
                    $dir = Yii::getAlias('@webroot/uploads/builder/logo/');
                    FileHelper::createDirectory($dir . $model->id . '/');
                    $fileName = 'logo.' . $model->logo->extension;
                    $model->logo->saveAs($dir . $model->id . '/' . $fileName);
                    $model->logo = '/uploads/builder/logo/' . $model->id . '/' . $fileName;
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
                    $dir = Yii::getAlias('@webroot/uploads/builder/price/');
                    FileHelper::createDirectory($dir . $model->id . '/');
                    $fileName = 'pricelist.' . $model->price_list->extension;
                    $model->price_list->saveAs($dir . $model->id . '/' . $fileName);
                    $model->price_list = '/uploads/builder/price/' . $model->id . '/' . $fileName;
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
                            $image = new BuilderImage();
                            $image->builder_id = $model->id;
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
                            $benefit = new BuilderBenefit();
                            $benefit->builder_id = $model->id;
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
                Yii::$app->session->setFlash('success', 'Партнер добавлен успешно');
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка при создании партнера');
            }


            return $this->redirect(Url::to(['/admin/modules/partner/builder/update', 'id' => $model->id]));
        }
        $users = User::find()->alias('u')->select(['u.username', 'u.id'])
            ->leftJoin(['p' => Builder::tableName()], 'u.id = p.agent_id')
            ->where(['is', 'p.agent_id', null])
            ->andWhere(['not in', 'u.role', ['admin', 'manager']])
            ->indexBy('id')
            ->column();
        if ($model->agent) {
            $users[$model->agent_id] = $model->agent->username;
        }
        return $this->render('_form', [
            'model' => $model,
            'users' => $users
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
            $model = BuilderBenefit::findOne(['id' => $id]);
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
        $dir = Yii::getAlias('@webroot/uploads/builder/item/');
        $path = date('ymdHis') . '/';
        if (!is_dir($dir . $path)) {
            FileHelper::createDirectory($dir . $path);
        }

        for ($i = 0; $i < count($fileNames); $i++) {
            $fileName = str_replace(' ', '_', $fileNames[$i]);
            $target = $dir . $path . $fileName;
            if (move_uploaded_file($images['tmp_name'][$i], $target)) {
                $success = true;
                $paths[] = '/uploads/builder/item/' . $path . $fileName;
                $fullPaths[] = $dir . $path . $fileName;
                $model = new BuilderImage();
                $model->file = '/uploads/builder/item/' . $path . $fileName;
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
     * Удаление картинки застройщика через ajax
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        if (intval($get['id'])) {
            $model = BuilderImage::findOne(['id' => $get['id']]);
            $item = Builder::find()->where(['image_id' => $get['id']])->one();
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
        $model = BuilderImage::findOne(['id' => $id]);
        if ($model) {
            $item = $model->builder;
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
        $model->is_deleted = Builder::IS_DELETED;
        if ($model->save()) {
            return $this->redirect(Yii::$app->request->get('back'));
        }
        throw new Exception('Ошибка при удалении партнера');
    }


    /**
     * @param $id
     * @return Builder|null|ActiveRecord
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Builder::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}