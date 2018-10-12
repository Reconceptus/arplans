<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace frontend\widgets\benefit;

use modules\partner\models\About;
use modules\partner\models\AboutBenefit;
use yii\base\Widget;


class Benefit extends Widget
{
    public $viewName = 'benefits';
    public $model;
    public $type = 'shop/service';

    public function run()
    {
        if ($this->model instanceof About) {
            $benefits = AboutBenefit::find()->all();
        } else {
            $benefits = $this->model->benefits;
        }
        $content = $this->render('benefits', ['benefits' => $benefits, 'type' => $this->type]);
        return $content;
    }
}