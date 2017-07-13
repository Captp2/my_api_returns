<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\User;

class Task extends \yii\db\ActiveRecord
{
    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    public function relations(){
        return array(
                'user' => array(self::BELONGS_TO, 'User', 'user_id')
            );
    }

    public function rules(){
        return [
            [['title', 'description', 'user_id', 'status'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['status', 'user_id'], 'integer', 'integerOnly' => true],
            [['user_id'], 'validateUserId']
        ];
    }

    public function validateUserId($attribute, $params, $validator){
        $user = new User();
        if(!$user->find($this->$attribute)){
            $this->addError($attribute, 'Utilisateur inconnu');
        }
    }
}
