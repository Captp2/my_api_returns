<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends \yii\db\ActiveRecord
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
            'tasks' => array(self::HAS_MANY, 'Task', 'user_id')
        );
    }

    public function rules(){
        return [
            [['username', 'email'], 'required'],
            [['username'], 'string', 'max' => 50],
            [['email'], 'email']
        ];
    }
}
