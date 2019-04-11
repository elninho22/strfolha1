<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */

class LoginForm extends Model
{
    public $usua_dins;
    public $usua_nivel;
    public $usua_nome;
    public $usua_pass;
    public $usua_mail;
    public $usua_hash;
    public $usua_logi;
    public $usua_foto;
   // public $rememberMe = false;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['usua_mail', 'usua_pass'], 'required'],
            // rememberMe must be a boolean value
           // ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['usua_pass', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->usua_pass)) {
                $this->addError($attribute, 'Senha ou usuário invalidos');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->usua_mail);
        }

        return $this->_user;
    }

        public function attributeLabels()
    {
        return [
            'usua_codi' => 'Código',
            'usua_nome' => 'Nome',
            'usua_dins' => 'Dins',
            'usua_pass' => 'Senha',
            'usua_mail' => 'E-mail',
            'usua_hash' => 'Hash',
            'usua_nivel' => 'Nivel',
            'usua_foto' => 'Foto',
            'usua_logi' => 'Usuário',
        ];
    }


}
