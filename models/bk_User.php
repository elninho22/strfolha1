<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $usua_codi;
    public $usua_mail;
    public $usua_pass;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'usua_mail' => 'admin',
            'usua_pass' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'usua_mail' => 'demo',
            'usua_pass' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($usua_codi)
    {
        return isset(self::$users[$usua_codi]) ? new static(self::$users[$usua_codi]) : null;
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
        foreach (self::$users as $user) {
            if (strcasecmp($user['usua_mail'], $usua_mail) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
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
