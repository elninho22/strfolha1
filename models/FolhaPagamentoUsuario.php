<?php

namespace app\models;
use app\components\Upload;
use app\models\PagamentoUtil;

use Yii;

/**
 * This is the model class for table "folha_pagamento".
 *
 * @property int $fopa_codi
 * @property string $fopa_arquivo arquivo
 * @property string $fopa_data data automatica
 * @property string $fopa_text comentario
 * @property int $fopa_usua id do usuario
 * @property int $fopa_guest id do gestor
 * @property int $fopa_stat status da folha
 *
 * @property FolhaHistorico[] $folhaHistoricos
 * @property Usuario $fopaUsua
 */
class FolhapagamentoUsuario extends \yii\db\ActiveRecord
{
    public $arquivo;

    public static function tableName()
    {
        return 'folha_pagamento';
    }


    public function rules()
    {
        return [
            [['fopa_data'], 'safe'],
            [['fopa_usua','fopa_guest','fopa_data','fopa_arquivo'], 'required'],
            [['fopa_usua','fopa_guest','fopa_stat'], 'integer'],
            //[['fopa_arquivo'], 'string', 'max' => 145],
            [[ 'arquivo'], 'file', /*'skipOnEmpty' => false, 'maxSize' => (1 * (4024*4024)),*/ "extensions" => "pdf, png, jpg, jpeg"],
            [['fopa_text'], 'string', 'max' => 100],
            [['fopa_usua'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fopa_usua' => 'usua_codi']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fopa_codi' => 'Código',
            'fopa_arquivo' => 'Arquivo',
            'fopa_data' => 'Mês de Referência',
            'fopa_text' => 'Observação',
            'fopa_guest' => 'Gestor',
            'fopa_usua' => 'Usuário',
            'fopa_stat' => 'Status',
        ];
    }

    public function getFolhaHistoricos()
    {
        return $this->hasMany(FolhaHistorico::className(), ['fopa_fopa' => 'fopa_codi']);
    }

    public function getFopaUsua()
    {
        return $this->hasOne(Usuario::className(), ['usua_codi' => 'fopa_usua']);
    }
}
