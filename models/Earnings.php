<?php

namespace app\models;

use app\helpers\ErrorProcessor;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\Expression;

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
 * @property Sources $sourceModel
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
            [['source', 'inflowDescription', 'inflowAmount'], 'required'],
            [['source'], 'integer'],
            [[ 'inflowAmount'], 'number','min'=>100],
            ['previousBalance','number'],
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

    public function behaviors()
    {

        return[
            /* TODO: implement behavior to set previous balance based on source input
             * [
                'class'=>AttributeBehavior::class,
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['previousBalance'],
                ],
                //dd(Yii::$app->request->post('source')),
                'value'=>
            ],*/
            [
                'class'=>AttributeBehavior::class,
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['createdAt'],
                    ],
                    'value'=>new Expression('NOW()')
            ],
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

    public function beforeSave($insert)
    {
        //set previous balance from source
        $this->previousBalance=$this->sourceModel->currentBalance;
        //update current balance of source
        $this->sourceModel->currentBalance+=$this->inflowAmount;
        //save updated value of source
        if(!$this->sourceModel->save()){
            //TODO: don't send db errors to ui
            throw new Exception(ErrorProcessor::arrayToString($this->sourceModel->errors));
        }
        return parent::beforeSave(true);
    }
}
