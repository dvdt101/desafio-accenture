<?php

namespace app\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'ORDERS';
    }

    public function rules()
    {
        return [
            [['CLIENT_ID', 'TOTAL_VALUE', 'STATUS'], 'required'],
            ['TOTAL_VALUE', 'number', 'min' => 0],
            ['STATUS', 'in', 'range' => ['PENDENTE', 'PAGO', 'CANCELADO']],
            ['CLIENT_ID', 'exist', 'targetClass' => Client::class, 'targetAttribute' => ['CLIENT_ID' => 'ID']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CLIENT_ID' => 'Cliente',
            'ORDER_DATE' => 'Data do Pedido',
            'TOTAL_VALUE' => 'Valor Total',
            'STATUS' => 'Status',
        ];
    }


    public function getClient()
    {
        return $this->hasOne(Client::class, ['ID' => 'CLIENT_ID']);
    }
}
