<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "earnings".
 *
 * @property int $id
 * @property int $source
 * @property float $previousBalance
 * @property string $inflowDescription
 * @property float $inflowAmount
 * @property string $createdAt
 *
 * @property Sources $source0
 */
class Earnings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'earnings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['source', 'previousBalance', 'inflowDescription', 'inflowAmount'], 'required'],
            [['source'], 'integer'],
            [['previousBalance', 'inflowAmount'], 'number'],
            [['createdAt'], 'safe'],
            [['inflowDescription'], 'string', 'max' => 255],
            [['source'], 'exist', 'skipOnError' => true, 'targetClass' => Sources::class, 'targetAttribute' => ['source' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source' => 'Source',
            'previousBalance' => 'Previous Balance',
            'inflowDescription' => 'Inflow Description',
            'inflowAmount' => 'Inflow Amount',
            'createdAt' => 'Created At',
        ];
    }

    public function bahaviors()
    {
        return[
            [

            ]
        ];
    }
    /**
     * Gets query for [[Source0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSourceModel()
    {
        return $this->hasOne(Sources::class, ['id' => 'source']);
    }
}
