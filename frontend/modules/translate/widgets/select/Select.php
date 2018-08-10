<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 02.08.2018
 * Time: 17:30
 */

namespace frontend\modules\translate\widgets\select;


use Yii;

class Select extends \yii\base\Widget
{
    public function run()
    {
        $languages = Yii::$app->params['languages'];
        $current = Yii::$app->language;
        $langs[] = $current;
        foreach ($languages as $language) {
            if ($language !== $current) {
                $langs[] = $language;
            }
        }
        $content = $this->render('index', ['langs' => $langs]);
        return $content;
    }
}