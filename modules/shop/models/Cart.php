<?php

namespace modules\shop\models;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

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
            [['guid', 'item_id'], 'unique', 'targetAttribute' => ['guid', 'item_id']],
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
        $query = Yii::$app->db->createCommand("SELECT sum(count) FROM " . Cart::tableName() . " WHERE guid = '{$cartGuid}'");
        return $query->queryScalar();
    }

    /**
     * Устанавливает идентификатор корзины
     * @return mixed|string
     * @throws \yii\base\Exception
     */
    public static function setGuid()
    {
        if (isset(Yii::$app->request->cookies['cart'])) {
            $cart = Yii::$app->request->cookies['cart'];
            $cart = $cart ? $cart->value : null;
        }
        if (!isset($cart)) {
            if (!Yii::$app->user->isGuest) {
                $cartGuid = self::findOne(['user_id' => Yii::$app->user->id]);
                if ($cartGuid) {
                    $cart = $cartGuid->guid;
                }
            }
        }
        if (!isset($cart)) {
            $cart = Yii::$app->security->generateRandomString();
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name'  => 'cart',
                'value' => $cart
            ]));
        }
        return $cart;
    }

    /**
     * @param $userId
     * @return int
     */
    public static function clearUserCart($userId)
    {
        return self::deleteAll(['user_id' => $userId]);
    }

    /**
     * @param $guid
     * @return int
     */
    public static function clearUserCartByGuid($guid)
    {

        return self::deleteAll(['guid' => $guid]);
    }

    /**
     * @param bool $active
     * @return array
     */
    public static function getInCart($active = true)
    {
        if (Yii::$app->user->isGuest) {
            return [];
        } else {
            $query = Cart::find()->alias('c');
            if ($active) {
                $query->innerJoin(Item::tableName() . ' i', 'i.id = c.item_id')
                    ->where(['i.is_active' => Item::IS_ACTIVE, 'i.is_deleted' => Item::IS_NOT_DELETED]);
            }
            $query->andWhere(['c.user_id' => Yii::$app->user->id]);
            $models = $query->all();
            return ArrayHelper::map($models, 'item_id', 'count');
        }
    }

    /**
     * Цена со скидкой за весь лот, включая альбомы
     * @param $count
     * @param $albumPrice
     * @return float
     */
    public function getLotPrice($albumPrice)
    {
        $price = $this->item->getPrice();
        if ($this->count > 1) {
            $result = $price + ($this->count - 1) * (float)$albumPrice;
        } else {
            $result = $price;
        }
        return $result;
    }
}
