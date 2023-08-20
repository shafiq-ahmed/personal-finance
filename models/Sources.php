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

    const IS_PRIMARY = [1 => 'Yes', 0 => 'No'];
    const SOURCE_IS_PRIMARY=1;
    const SOURCE_IS_NOT_PRIMARY=0;
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
            [['name', 'currentBalance'], 'required'],
            [['isPrimary'], 'integer'],
            [['currentBalance'], 'number', 'min' => 500],
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
        return $this->hasMany(Expense::class, ['source' => 'id']);
    }

    /**
     * Returns all the possible isPrimary values as key value pairs
     * @return array[]
     */
    public static function getAllIsPrimaryKeyValues()
    {
        //TODO: find alternative usage for IS_PRIMARY const
        return [['id' => 0, 'value' => 'No'], ['id' => 1, 'value' => 'Yes']];
    }

    /**
     * Before saving a source, all the other sources with isPrimary value 1
     * are changed to isPrimary value 0. Only executes when the source being saved has a
     * isPrimary value of 1
     * */
    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        $allSourcesUpdated = true;
        if ($this->isPrimary == self::SOURCE_IS_PRIMARY) {
            $isPrimarySources = Sources::findAll(['isPrimary' => self::SOURCE_IS_PRIMARY]);
            foreach ($isPrimarySources as $source) {
                $source->isPrimary = self::SOURCE_IS_NOT_PRIMARY;
                if (!$source->save()) {
                    $allSourcesUpdated = false;
                }
            }
        //how should the error message be sent to the controller and shown to the user
        }
        return $allSourcesUpdated;
    }
}
