<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $user_name
 * @property string $password
 * @property string $auth_key
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'user_name', 'password', 'auth_key'], 'required'],
            [['first_name', 'last_name', 'auth_key'], 'string', 'max' => 100],
            [['user_name'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'user_name' => 'User Name',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findByUsername($username) {
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($password) {
        return $this->password === $password;
    }
}
