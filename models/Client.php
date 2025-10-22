<?php

namespace app\models;

use yii\db\ActiveRecord;

class Client extends ActiveRecord
{
    public static function tableName()
    {
        return 'CLIENTS';
    }

    public function rules()
    {
        return [
            [['NAME', 'EMAIL', 'STATUS'], 'required', 'message' => 'O campo {attribute} é obrigatório.'],
            ['EMAIL', 'email', 'message' => 'Digite um e-mail válido.'],
            ['EMAIL', 'unique', 'message' => 'Este e-mail já está cadastrado.'],
            ['STATUS', 'in', 'range' => ['ATIVO', 'INATIVO'], 'message' => 'Selecione um status válido.'],
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

    public function getFormattedCreatedAt()
    {
        $dt = \DateTime::createFromFormat('d-M-y h.i.s.u A', $this->CREATED_AT)
            ?: \DateTime::createFromFormat('d-M-y h.i.s A', $this->CREATED_AT);

        return $dt ? $dt->format('d/m/Y H:i') : $this->CREATED_AT;
    }
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['CLIENT_ID' => 'ID']);
    }
}
