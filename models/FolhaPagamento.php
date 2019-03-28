<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "folha_pagamento".
 *
 * @property int $fopa_codi
 * @property string $fopa_arquivo arquivo
 * @property string $fopa_data data automatica
 * @property string $fopa_text comentario
 * @property int $fopa_usua id do usuario
 *
 * @property FolhaHistorico[] $folhaHistoricos
 * @property Usuario $fopaUsua
 */
class FolhaPagamento extends \yii\db\ActiveRecord
{
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
            [['fopa_usua'], 'required'],
            [['fopa_usua'], 'integer'],
            [['fopa_arquivo'], 'string', 'max' => 145],
            [['fopa_text'], 'string', 'max' => 45],
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fopa_codi' => 'Código',
            'fopa_arquivo' => 'Arquivo',
            'fopa_data' => 'Data de Envio',
            'fopa_text' => 'Descrição',
            'fopa_usua' => 'Gestor',
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
