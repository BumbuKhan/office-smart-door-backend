<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property int $user_id
 * @property string $action
 * @property string $description
 * @property string $response_data
 * @property string $datetime
 */
class Log extends \yii\db\ActiveRecord
{
    const LOG_ACTION_LOGIN = 'login';
    const LOG_ACTION_LOGOUT = 'logout';
    const LOG_ACTION_DOOR_OPEN = 'door_open';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'action', 'description'], 'required'],
            [['user_id'], 'integer'],
            [['action', 'response_data', 'user_ip'], 'string'],
            [['datetime'], 'safe'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'action' => 'Action',
            'description' => 'Description',
            'response_data' => 'Reasponse Data',
            'user_ip' => 'User IP',
            'datetime' => 'Datetime',
        ];
    }
}
