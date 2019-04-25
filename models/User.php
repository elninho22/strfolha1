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
        $model = Usuario::find()->where(['usua_codi'=>$usua_codi])->one();
        if ($model) {
            $user = self::getAttributesUserIdentity($model);
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
    public static function findByUsername($usua_mail, $usua_codi) {
        $model = Usuario::find()->where(['usua_mail' => trim( $usua_mail), 'usua_logi' => 20])->one();
        if ($model) {
            $user = self::getAttributesUserIdentity($model);
            return new static($user);
        }
        return null;
    }

    public static function getAttributesUserIdentity($modelAttributes) {
        /*
         * Verificar quais dados são necessários a serem gravados na sessão
         */
        $nome = Html::encode( $modelAttributes['usua_nome']);
        $userAttributes['usua_codi'] = $modelAttributes['usua_codi'];
        $userAttributes['usua_dins'] = $modelAttributes['usua_dins'];
        $userAttributes['usua_pass'] = $modelAttributes['usua_pass'];
        $userAttributes['usua_mail'] = $modelAttributes['usua_mail'];
        $userAttributes['usua_hash'] = $modelAttributes['usua_hash'];
        $userAttributes['usua_nivel'] = $modelAttributes['usua_nivel'];
        $userAttributes['usua_foto'] = $modelAttributes['usua_foto'];
        $userAttributes['usua_logi'] = $modelAttributes['usua_logi'];
        $userAttributes['usua_guest'] = $modelAttributes['usua_guest'];
        $userAttributes['authKey'] = $modelAttributes['authKey'];
        $userAttributes['usua_nome'] = $modelAttributes[ 'usua_nome'];
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
