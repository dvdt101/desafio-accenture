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
            [['CLIENT_ID', 'TOTAL_VALUE', 'STATUS', 'TYPE', 'DESCRIPTION'], 'required', 'message' => 'O campo {attribute} é obrigatório.'],
            [
                'TOTAL_VALUE',
                'filter',
                'filter' => function ($v) {
                    if ($v === null || $v === '')
                        return $v;
                    $v = str_replace('.', '', $v);
                    $v = str_replace(',', '.', $v);
                    return $v;
                }
            ],
            ['TOTAL_VALUE', 'validateTotalValue'],
            ['STATUS', 'in', 'range' => ['PENDENTE', 'PAGO', 'CANCELADO']],
            ['TYPE', 'in', 'range' => ['SERVIÇOS', 'MAQUINAS', 'PEÇAS']],
            ['CLIENT_ID', 'exist', 'targetClass' => Client::class, 'targetAttribute' => ['CLIENT_ID' => 'ID']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CLIENT_ID' => 'Cliente',
            'ORDER_DATE' => 'Data do Pedido',
            'TOTAL_VALUE' => 'Valor(R$)',
            'STATUS' => 'Status',
            'TYPE' => 'Tipo',
            'DESCRIPTION' => 'Descrição',
        ];
    }


    public function getClient()
    {
        return $this->hasOne(Client::class, ['ID' => 'CLIENT_ID']);
    }

    public function validateTotalValue($attribute)
    {
        $value = $this->$attribute;

        if (!is_numeric($value)) {
            $this->addError($attribute, 'Informe um valor válido');
            return;
        }
        if ($value < 0) {
            $this->addError($attribute, 'Informe um valor que não seja negativo');
            return;
        }
        $this->$attribute = $value;
    }
    public function getFormattedOrderDate()
    {
        $dt = \DateTime::createFromFormat('d-M-y h.i.s.u A', $this->ORDER_DATE)
            ?: \DateTime::createFromFormat('d-M-y h.i.s A', $this->ORDER_DATE);

        return $dt ? $dt->format('d/m/Y H:i') : $this->ORDER_DATE;
    }
}
