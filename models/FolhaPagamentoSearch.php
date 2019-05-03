<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FolhaPagamento;

use Yii;

/**
 * FolhaPagamentoSearch represents the model behind the search form of `app\models\FolhaPagamento`.
 */
class FolhaPagamentoSearch extends FolhaPagamento
{
    public function rules()
    {
        return [
            [['fopa_codi', 'fopa_usua'], 'integer'],
            [['fopa_data', 'fopa_stat'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        if(!Usuario::find()->where(['usua_codi'=>Yii::$app->user->identity->usua_codi, 'usua_nivel'=> '98'])->exists()){
         $query = FolhaPagamento::find()->where(['fopa_usua' => Yii::$app->user->identity->usua_codi])->orderBy('fopa_stat');
        }else{
        $query = FolhaPagamento::find()->where(['fopa_guest' => Yii::$app->user->identity->usua_codi])->orderBy('fopa_stat');
    }

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'fopa_codi' => $this->fopa_codi,
            'fopa_data' => $this->fopa_data,
            'fopa_usua' => $this->fopa_usua,
            'fopa_stat' => $this->fopa_stat,
        ]);

        $query->andFilterWhere(['like', 'fopa_arquivo', $this->fopa_arquivo]);

        return $dataProvider;
    }
}
