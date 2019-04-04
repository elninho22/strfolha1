<?php

namespace app\models;

use app\models\Usuario;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $usua_codi;
    public $usua_dins;
    public $usua_nivel;
    public $usua_nome;
    public $usua_pass;
    public $usua_mail;
    public $usua_hash;
    public $usua_logi;
    public $usua_foto;
    public $usua_guest;
    //public $rememberMe = true;

/*    private static $users = [
        '1' => [
            'usua_codi' => '$usua_codi',
            'usua_logi' => '$usua_logi',
            'usua_pass' => '$usua_pass',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];*/


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($usua_codi)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        $user = Usuario::find($usua_codi)->one();

        if ($user)
        {
            return new static($user);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($usua_mail)
    {
/*        foreach (self::$users as $user) {
            if (strcasecmp($user['usua_logi'], $usua_logi) === 0) {
                return new static($user);
            }
        }*/

        $user = Usuario::find()->where(['usua_mail' => $usua_mail])->one();
        if ($user)
        {
            return new static($user);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->usua_codi;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null; //$this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return null; //$this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($usua_pass)
    {
        return $this->usua_pass === $usua_pass;
    }
}
