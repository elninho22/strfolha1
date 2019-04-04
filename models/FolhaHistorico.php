<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "folha_historico".
 *
 * @property int $fohi_codi
 * @property string $fohi_data
 * @property string $fohi_text
 * @property string $fohi_arq
 * @property int $fopa_fopa Id da folha de pagamento
 *
 * @property FolhaPagamento $fopaFopa
 */
class FolhaHistorico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'folha_historico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fohi_data'], 'safe'],
            [['fopa_fopa'], 'required'],
            [['fopa_fopa'], 'integer'],
            [['fohi_text', 'fohi_arq'], 'string', 'max' => 45],
            [['fopa_fopa'], 'exist', 'skipOnError' => true, 'targetClass' => FolhaPagamento::className(), 'targetAttribute' => ['fopa_fopa' => 'fopa_codi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fohi_codi' => 'Código',
            'fohi_data' => 'Data de Envio',
            'fohi_text' => 'Mês de Referencia   ',
            'fohi_arq' => 'Arquivo',
            'fopa_fopa' => 'Folha de Pagamento ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFopaFopa()
    {
        return $this->hasOne(FolhaPagamento::className(), ['fopa_codi' => 'fopa_fopa']);
    }
}
