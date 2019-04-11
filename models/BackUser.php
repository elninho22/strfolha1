<?php

namespace app\models;

use app\models\Usuario;

class BackUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
    public $authKey;
    //public $rememberMe = true;


    public static function findIdentity($usua_codi)
    {
        
        return static::findOne($usua_codi);
        //return isset(self::$user[$usua_codi]) ? new static(self::$user[$usua_codi]) : null;
       /* $user = Usuario::find($usua_codi)->one();

        if ($user)
        {
            return new static($user);
        }
        return null;*/
    }
/*
        public static function findIdentity($usua_codi)
    {
        $user = Usuario::find($usua_codi)->one();
        if ($user)
        {
            return new static ($user);
        }
        return null;
    }*/

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
