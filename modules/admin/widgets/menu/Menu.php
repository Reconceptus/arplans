<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 10:35
 */

namespace modules\admin\widgets\menu;

use Yii;
use yii\base\Widget;
use yii\db\Query;

class Menu extends Widget
{
    public $viewName = 'index';

    public function run()
    {
        $query = new Query();
        $modules = $query->select('*')
            ->from('module')
            ->createCommand()
            ->queryAll();

        foreach ($modules as $k => $module) {
            $modules[$k]['id'] = (int)$module['id'];
            $module[$k]['parent_id'] = (int)$module['parent_id'];
        }
        $content = $this->render($this->viewName, [
            'modules'  => $this->buildMenu($modules),
            'selected' => $this->getSelected()
        ]);
        return $content;
    }

    /**
     * Делаем структуру меню в админке
     * @param $models
     * @return array
     */
    private function buildMenu($models)
    {
        $result = [];

        foreach ($models as $model) {

            if ($model['parent_id'] > 0)
                $result[$model['parent_id']]['items'][] = ['name' => $result[$model['parent_id']]['name'] . '/' . $model['name'], 'title' => $model['title']];
            else {
                $result[$model['id']]['name'] = $model['name'];
                $result[$model['id']]['title'] = $model['title'];
            }
        }

        return $result;
    }

    /**
     * Получаем выбранный пункт
     * @return array
     */
    private function getSelected()
    {
        $path = str_replace('/admin/', '', Yii::$app->request->url);
        $pathArray = explode('/', $path);
        $result = [];

        if(count($pathArray) >= 2) {
            $result = [$pathArray[0] => true, 'module'=> $pathArray[1]];
            if(count($result) >=3 ) {
                $result['controller'] = $pathArray[2];
            }
        }

        return $result;
    }
}