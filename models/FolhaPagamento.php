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
 * @property int $fopa_dins data de cadastro automatica
 *
 * @property FolhaHistorico[] $folhaHistoricos
 * @property Usuario $fopaUsua
 */
class FolhaPagamento extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'folha_pagamento';
    }

    public function rules()
    {
        return [
            [['fopa_data'], 'safe'],
            [['fopa_usua','fopa_guest'], 'required'],
            [['fopa_dins'], 'safe'],
            [['fopa_usua','fopa_guest','fopa_stat'], 'integer'],
            [['fopa_arquivo'], 'string', 'max' => 145],
            [['fopa_text'], 'string', 'max' => 150],
            [['fopa_usua'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fopa_usua' => 'usua_codi']],
        ];
    }

        //funcao apra realizar upload de arquivos
    public function actionUpload()
    {
        $model = new FolhaPagamento();

        if (Yii::$app->request->isPost) {
            $model->fopa_arquivo = UploadedFile::getInstance($model, 'fopa_arquivo');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
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
            'fopa_dins' => 'Data autoamtica',
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
    public static function nomeUsuario($id)
    {
        return $id ? Usuario::find()->where(['usua_codi' => $id])->one() : '';
       
    }
    public static function idFolhaPagamento($id)
    {
        return $id ? FolhaPagamento::find()->where(['fopa_codi' => $id])->one() : '';
       
    }
    public static function linkArq($fopa_arquivo)
    {
        return $fopa_arquivo ? FolhaPagamento::find()->where(['fopa_arquivo' => $fopa_arquivo])->one() : '';
       
    }
    public static function nomeGestorf($id)
    {
        return $id ? Usuario::find()->where(['usua_codi' => $id])->one() : '';
    }
    public static function emailGestor($id)
    {
        return $id ? Usuario::find()->where(['usua_codi' => $id])->one() : '';
    }

}
