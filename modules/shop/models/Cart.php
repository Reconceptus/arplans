<?php

namespace modules\shop\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "shop_cart".
 *
 * @property int $id
 * @property string $guid
 * @property int $user_id
 * @property int $item_id
 * @property int $count
 *
 * @property Item $item
 * @property User $user
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'count'], 'integer'],
            [['guid'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'guid'    => 'Guid',
            'user_id' => 'User ID',
            'item_id' => 'Item ID',
            'count'   => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function countGoods(string $cartGuid)
    {
        $query = Yii::$app->db->createCommand("SELECT sum(count) FROM ".Cart::tableName()." WHERE guid = '{$cartGuid}'");
        return $query->queryScalar();
    }
}
