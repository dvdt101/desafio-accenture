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
            [['CLIENT_ID', 'TOTAL_VALUE', 'STATUS'], 'required', 'message' => 'O campo {attribute} é obrigatório.'],
            ['TOTAL_VALUE', 'number', 'min' => 0, 'message' => 'O campo {attribute} deve ser um número.'],
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

    public function getFormattedOrderDate()
    {
        $dt = \DateTime::createFromFormat('d-M-y h.i.s.u A', $this->ORDER_DATE)
            ?: \DateTime::createFromFormat('d-M-y h.i.s A', $this->ORDER_DATE);

        return $dt ? $dt->format('d/m/Y H:i') : $this->ORDER_DATE;
    }

}
