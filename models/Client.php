<?php

namespace app\models;

use yii\db\ActiveRecord;

class Client extends ActiveRecord
{
    public static function tableName() { return 'CLIENTS'; }

    public function rules()
    {
        return [
            [['NAME', 'EMAIL', 'STATUS'], 'required'],
            ['EMAIL', 'email'],
            ['EMAIL', 'unique'],
            ['STATUS', 'in', 'range' => ['ATIVO', 'INATIVO']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NAME' => 'Nome',
            'EMAIL' => 'E-mail',
            'STATUS' => 'Status',
            'CREATED_AT' => 'Data de cadastro',
        ];
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, ['CLIENT_ID' => 'ID']);
    }
}
