<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\partner\frontend\controllers;

use common\models\Config;
use modules\partner\models\Builder;
use modules\partner\models\Village;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;


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
        $model = Village::findOne(['slug' => $slug, 'is_active' => Builder::IS_ACTIVE, 'is_deleted' => Builder::IS_NOT_DELETED, 'no_page' => Builder::IS_NOT_ACTIVE]);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $this->render('view', ['model' => $model]);
    }

    public function actionAdd()
    {
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($post) {
                if (isset($post['processing_agree']) && $post['processing_agree'] === 'on') {
                    $file = UploadedFile::getInstanceByName('file');
                    $mail = Yii::$app->mailer->compose('add-village', ['model' => $post])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                        ->setTo(Config::getValue('requestEmail'))
                        ->setSubject('Новая заявка о добавлении поселка');
                    if ($file) {
                        $mail->attachContent(file_get_contents($file->tempName), ['fileName' => $file->baseName . '.' . $file->extension]);
                    }
                    $mail->send();
                    return ['status' => 'success', 'message' => 'Спасибо! Мы обязательно с вами свяжемся'];
                }
            }
            return ['status' => 'fail'];
        }
        return $this->render('add');
    }
}