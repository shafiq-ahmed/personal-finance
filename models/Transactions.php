<?php

namespace app\models;

use app\helpers\ErrorProcessor;
use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property int $expenseId
 * @property int $sourceId
 * @property string $createdAt
 *
 * @property Expense $expense
 * @property Sources $source
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expenseId', 'sourceId', 'createdAt'], 'required'],
            [['expenseId', 'sourceId'], 'integer'],
            [['createdAt'], 'safe'],
            [['expenseId'], 'exist', 'skipOnError' => true, 'targetClass' => Expense::class, 'targetAttribute' => ['expenseId' => 'id']],
            [['sourceId'], 'exist', 'skipOnError' => true, 'targetClass' => Sources::class, 'targetAttribute' => ['sourceId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expenseId' => 'Expense ID',
            'sourceId' => 'Source ID',
            'createdAt' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Expense]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpense()
    {
        return $this->hasOne(Expense::class, ['id' => 'expenseId']);
    }

    /**
     * Gets query for [[Source]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(Sources::class, ['id' => 'sourceId']);
    }

    /**
     * Saves the transaction data after expense payment is completed
     * and source table is updated
     * */
    public static function saveExpenseTransaction($sourceId, $expenseId)
    {
        $transaction = new  Transactions();
        $transaction->sourceId = $sourceId;
        $transaction->expenseId = $expenseId;
        $transaction->createdAt = date('Y-m-d H:i:s', strtotime('+6 hours'));
        if (!$transaction->save()) {
            throw  new \Exception(ErrorProcessor::arrayToString($transaction->errors));
        }

    }
}
