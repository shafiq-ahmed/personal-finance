<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sources".
 *
 * @property int $id
 * @property string $name
 * @property int $isPrimary
 * @property float $currentBalance
 */
class Sources extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const IS_PRIMARY=[1=>'Yes',0=>'No'];
    public static function tableName()
    {
        return 'sources';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['isPrimary'], 'integer'],
            [['currentBalance'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'isPrimary' => 'Is Primary',
            'currentBalance' => 'Current Balance',
        ];
    }

    public function getExpenses()
    {
        return $this->hasMany(Expense::class,['source'=>'id']);
    }

    /**
     * Returns all the possible isPrimary values as key value pairs
     * @return array[]
     */
    public static function getAllIsPrimaryKeyValues()
    {
        //TODO: find alternative usage for IS_PRIMARY const
        return [['id'=>0,'value'=>'No'],['id'=>1,'value'=>'Yes']];
    }
}
