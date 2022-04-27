<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id ID
 * @property string $name 名字
 * @property string|null $code 代号
 * @property string $t_status 状态
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_status'], 'string'],
            [['t_status'], 'required'],
            [['t_status'], 'in', 'range' => ['ok', 'hold']],
            [['name'], 'string', 'max' => 50],
            [['name'], 'required'],
            [['code'], 'string', 'max' => 3],
            [['code'], 'unique'],
            [['code'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名字',
            'code' => '代号',
            't_status' => '状态',
        ];
    }
    
    /**
     * @return string[]
     */
    public function getTStatusList()
    {
        return [
            'ok' => 'Ok',
            'hold' => 'Hold',
        ];
    }
}
