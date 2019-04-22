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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'folha_pagamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fopa_data'], 'safe'],
            [['fopa_usua','fopa_guest'], 'required'],
            [['fopa_usua','fopa_guest','fopa_stat'], 'integer'],
            //[['fopa_arquivo'], 'string', 'max' => 145],
            [[ 'arquivo'], 'file', /*'skipOnEmpty' => false, 'maxSize' => (1 * (1024*1024)),*/ "extensions" => "pdf,png, jpg, jpeg"],
            [['fopa_text'], 'string', 'max' => 100],
            [['fopa_usua'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fopa_usua' => 'usua_codi']],
        ];
    }

        //funcao apra realizar upload de arquivos
    // public function actionUpload()
    // {
    //     $model = new FolhapagamentoUsuario();

    //     if (Yii::$app->request->isPost) {
    //         $model->fopa_arquivo = UploadedFile::getInstance($model, 'fopa_arquivo');
    //         if ($model->upload()) {
    //             // file is uploaded successfully
    //             return;
    //         }
    //     }

    //     return $this->render('upload', ['model' => $model]);
    // }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fopa_codi' => 'Código',
            'arquivo' => 'Arquivo',
            'fopa_data' => 'Mês de Referencia',
            'fopa_text' => 'Observação',
            'fopa_guest' => 'Gestor',
            'fopa_usua' => 'Usuario',
            'fopa_stat' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolhaHistoricos()
    {
        return $this->hasMany(FolhaHistorico::className(), ['fopa_fopa' => 'fopa_codi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFopaUsua()
    {
        return $this->hasOne(Usuario::className(), ['usua_codi' => 'fopa_usua']);
    }
}
