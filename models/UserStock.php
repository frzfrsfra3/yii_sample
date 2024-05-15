<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_stocks".
 *
 * @property int $id
 * @property int $user_id
 * @property string $stock_symbol
 * @property int $quantity
 *
 * @property User $user
 */
class UserStock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_stocks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'stock_symbol', 'quantity'], 'required'],
            [['user_id', 'quantity'], 'integer'],
            [['stock_symbol'], 'string', 'max' => 10],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'stock_symbol' => 'Stock Symbol',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
