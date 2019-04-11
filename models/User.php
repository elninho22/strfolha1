<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\base\Object;
use yii\helpers\Html;
use yii\web\IdentityInterface;

class User extends Object implements IdentityInterface {

   public $usua_codi;
   public $usua_nome;
   public $usua_dins;
   public $usua_pass;
   public $usua_mail;
   public $usua_hash;
   public $usua_nivel;
   public $usua_foto;
   public $usua_logi;
   public $usua_guest;
   public $authKey;

    /**
     * @inheritdoc
     */
    public static function findIdentity($usua_codi) {
        $modelUsuario = Usuario::find()->where(['usua_codi'=>$usua_codi])->one();
        if ($modelUsuario) {
            $user = self::getAttributesUserIdentity($modelUsuario);
            return new static($user);
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $modelUsuario = Usuario::find()->where(['usua_mail' => trim($username)])->one();
        if ($modelUsuario) {
            $user = self::getAttributesUserIdentity($modelUsuario);
            return new static($user);
        }
        return null;
    }

    public static function getAttributesUserIdentity($modelUsuarioAttributes) {
        /*
         * Verificar quais dados são necessários a serem gravados na sessão
         */
        $nome = Html::encode($modelUsuarioAttributes['usua_nome']);
        $userAttributes['usua_codi'] = $modelUsuarioAttributes['usua_codi'];
        $userAttributes['usua_dins'] = $modelUsuarioAttributes['usua_dins'];
        $userAttributes['usua_pass'] = $modelUsuarioAttributes['usua_pass'];
        $userAttributes['usua_mail'] = $modelUsuarioAttributes['usua_mail'];
        $userAttributes['usua_hash'] = $modelUsuarioAttributes['usua_hash'];
        $userAttributes['usua_nivel'] = $modelUsuarioAttributes['usua_nivel'];
        $userAttributes['usua_foto'] = $modelUsuarioAttributes['usua_foto'];
        $userAttributes['usua_logi'] = $modelUsuarioAttributes['usua_logi'];
        $userAttributes['usua_guest'] = $modelUsuarioAttributes['usua_guest'];
        $userAttributes['authKey'] = $modelUsuarioAttributes['authKey'];
        $userAttributes['usua_nome'] = $nome;
        return $userAttributes;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->usua_codi;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($usua_pass) {
        return $this->usua_pass === hash("sha256", $usua_pass);
    }
   
}
