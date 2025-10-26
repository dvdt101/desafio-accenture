<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $PASSWORD_PLAIN;
    public static function tableName()
    {
        return 'USERS';
    }

    public function rules()
    {
        return [
            [['NAME', 'EMAIL', 'USERNAME', 'PASSWORD_HASH', 'PROFILE', 'STATUS'], 'required', 'message' => 'O campo {attribute} é obrigatório.'],
            [['PASSWORD_PLAIN'], 'safe'],
            ['EMAIL', 'email', 'message' => 'Digite um e-mail válido.'],
            ['EMAIL', 'unique', 'message' => 'Este e-mail já está cadastrado.'],
            ['STATUS', 'in', 'range' => ['ATIVO', 'INATIVO']],
        ];
    }

        public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'PASSWORD_PLAIN'=> 'Senha',
            'USERNAME' => 'Usuário',
            'PROFILE' => 'Perfil',
            'STATUS' => 'Status',
            'EMAIL' => 'E-mail',
            'NAME' => 'Nome Completo',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['ACCESS_TOKEN' => $token]);
    }

    // helper pra buscar usuário pelo e-mail (vamos usar no login)
        public static function findByUserName($username)
    {
        return static::findOne(['USERNAME' => $username, 'STATUS' => 'ATIVO']);
    }
    public static function findByEmail($email)
    {
        return static::findOne(['EMAIL' => $email, 'STATUS' => 'ATIVO']);
    }

    public function getId()
    {
        return $this->ID;
    }

    public function getAuthKey()
    {
        return $this->AUTH_KEY ?? null;
    }

    public function validateAuthKey($authKey)
    {
        return $this->AUTH_KEY === $authKey;
    }

    public function validatePassword($passwordPlaintext)
    {
        return Yii::$app->security->validatePassword($passwordPlaintext, $this->PASSWORD_HASH);
    }

    public function setPassword($passwordPlaintext)
    {
        $this->PASSWORD_HASH = Yii::$app->security->generatePasswordHash($passwordPlaintext);
    }

    public function generateAuthKey()
    {
        $this->AUTH_KEY = Yii::$app->security->generateRandomString();
    }

     public function getFormattedCreatedAt()
    {
        $dt = \DateTime::createFromFormat('d-M-y h.i.s.u A', $this->CREATED_AT)
            ?: \DateTime::createFromFormat('d-M-y h.i.s A', $this->CREATED_AT);

        return $dt ? $dt->format('d/m/Y H:i') : $this->CREATED_AT;
    }
}
