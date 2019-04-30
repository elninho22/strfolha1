<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $usua_codi
 * @property string $usua_nome nome
 * @property string $usua_dins data de cadastro Automatica
 * @property string $usua_pass senha de acesso
 * @property string $usua_mail email para qual vai disparar a notificaçao
 * @property string $usua_hash Código para envia por email, assim pode recurar a senha de acesso
 * @property int $usua_nivel 1 usuario comum, 2 gestor
 * @property string $usua_foto
 * @property string $usua_logi Login para para acessar a ferramenta
 * @property string $usua_insc Código de cadastro do RH
 *
 * @property FolhaPagamento[] $folhaPagamentos
 */
class Usuario extends \yii\db\ActiveRecord
{
   public $gestor;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usua_nome', 'usua_mail', 'usua_guest'], 'required'],
            [['usua_dins'], 'safe'],
            [['usua_pass'], 'string', 'min' => 6],
            [['usua_insc'], 'string', 'max' => 15],
            [['gestor'], 'integer'],
            [['usua_nivel'], 'integer'],
            ['usua_mail', 'email'],
            [['usua_nome', 'usua_pass', 'usua_mail', 'usua_hash', 'usua_logi','authKey'], 'string', 'max' => 100],
            [['usua_foto'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usua_codi' => 'Código',
            'gestor' => 'Gestor',
            'usua_nome' => 'Nome completo',
            'usua_dins' => 'Dins',
            'usua_pass' => 'Senha',
            'usua_mail' => 'E-mail',
            'usua_hash' => 'Hash',
            'usua_nivel'=> 'Nivel',
            'usua_foto' => 'Foto',
            'usua_logi' => 'Username',
            'usua_guest' => 'Gestor',
            'usua_insc' => 'Matrícula',
            'authKey' => 'authKey',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolhaPagamentos()
    {
        return $this->hasMany(FolhaPagamento::className(), ['fopa_usua' => 'usua_codi']);
    }

    public static function nomeGestor($id)
    {
        return $id ? Usuario::find()->where(['usua_codi' => $id])->one() : '';
    }
}

