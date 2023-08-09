<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense".
 *
 * @property int $id
 * @property string $name
 * @property int $source
 * @property float $amount
 * @property string $month
 * @property string $expenseDate
 * @property int $createdAt
 * @property int $isPaid
 */
class Expense extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'amount', 'month', 'createdAt', 'isPaid'], 'required'],
            [['source', 'createdAt', 'isPaid'], 'integer'],
            [['amount'], 'number'],
            [['expenseDate'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['month'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'source' => 'Source',
            'amount' => 'Amount',
            'month' => 'Month',
            'expenseDate' => 'Expense Date',
            'createdAt' => 'Created At',
            'isPaid' => 'Is Paid',
        ];
    }


}
