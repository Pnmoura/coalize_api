<?php

namespace app\models\API\User;

use Yii;
use yii\db\ActiveRecord;

class CustomUser extends ActiveRecord
{
    public static function tableName()
    {
        return 'registerUser'; // Defina o nome da tabela do banco de dados, se necessário
    }

    public function rules()
    {
        return [
            [['username', 'password', 'name', 'cpf'], 'required'],
            [['username', 'password'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100],
            [['cpf'], 'string', 'max' => 14],
            [['username'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'name' => 'Name',
            'cpf' => 'CPF',
        ];
    }

    // Método para buscar um usuário pelo CPF
    public static function findByCpf($cpf)
    {
        return static::findOne(['cpf' => $cpf]);
    }
}
