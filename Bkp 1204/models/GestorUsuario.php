<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gestor_usuario".
 *
 * @property int $geus_gest
 * @property int $geus_usua
 */
class GestorUsuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gestor_usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['geus_gest', 'geus_usua'], 'required'],
            [['geus_gest', 'geus_usua'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'geus_gest' => 'Geus Gest',
            'geus_usua' => 'Geus Usua',
        ];
    }
}
