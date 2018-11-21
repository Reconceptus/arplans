<?php

namespace common\models;

use modules\partner\models\Partner;
use modules\partner\models\Village;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $center
 * @property int $sort
 * @property int $is_active
 *
 * @property Partner[] $partners
 * @property Village[] $villages
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'is_active'], 'integer'],
            [['slug', 'name', 'center'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'slug'      => 'Код',
            'name'      => 'Название',
            'center'    => 'Центр',
            'sort'      => 'Сортировка',
            'is_active' => 'Активен',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartners()
    {
        return $this->hasMany(Partner::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVillages()
    {
        return $this->hasMany(Village::className(), ['region_id' => 'id']);
    }

    /**
     * @param $id
     * @return string|null
     */
    public static function getNameById($id)
    {
        $model = self::findOne(['id' => $id]);
        if ($model) {
            return $model->name;
        }
        return null;
    }
}
