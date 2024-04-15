<?php

namespace app\models;

use yii\db\ActiveRecord;

class Client extends ActiveRecord
{
    public static function tableName()
    {
        return 'client'; // Nome da tabela no banco de dados
    }

    public function rules()
    {
        return [
            [['name', 'cpf'], 'required'],
            ['cpf', 'unique'],
            [['name', 'cpf', 'address', 'photo', 'gender'], 'string'],
        ];
    }

    public function fields()
    {
        return ['name', 'cpf', 'address', 'photo', 'gender'];
    }
}
