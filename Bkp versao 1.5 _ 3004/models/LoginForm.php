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
class LoginForm extends Model {

    public $usua_mail;
    public $usua_pass;
    public $usua_logi;
    public $captcha;
    public $rememberMe = true;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['usua_mail'], 'required'],
            [['usua_pass'], 'required'],
            [['usua_pass'], 'validatePassword'],
            //[['usua_nome'], 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'usua_mail' => 'Usuário',
            'usua_pass' => 'Senha',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->usua_pass)) {
                $this->addError($attribute, 'Usuário ou senha incorreto.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login() {
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
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->usua_mail, $this->usua_logi);
        }

        return $this->_user;
    }

}
