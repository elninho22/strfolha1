<?php

namespace app\models;

use Yii;

/***
 * vincular ID do usuario com ID do gestor
 * @property int $geus_gest
 * @property int $geus_usua
 */
class GestorUsuario extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'gestor_usuario';
    }


    public function rules()
    {
        return [
            [['geus_gest', 'geus_usua'], 'required'],
            [['geus_gest', 'geus_usua'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'geus_gest' => 'Geus Gest',
            'geus_usua' => 'Geus Usua',
        ];
    }
}
