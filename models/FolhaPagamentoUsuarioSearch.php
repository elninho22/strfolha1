<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FolhapagamentoUsuario;

use Yii;

/**
 * FolhapagamentoUsuarioSearch represents the model behind the search form of `app\models\FolhaPagamento`.
 */
class FolhapagamentoUsuarioSearch extends FolhapagamentoUsuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['fopa_codi', 'fopa_usua'], 'integer'],
            [['fopa_data', 'fopa_stat'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        
        if(!Usuario::find()->where(['usua_codi'=>Yii::$app->user->identity->usua_codi, 'usua_nivel'=> '1'])->exists()){
         $query = FolhapagamentoUsuario::find()->where(['fopa_usua' => Yii::$app->user->identity->usua_codi]);
        }else{
        $query = FolhapagamentoUsuario::find()->where(['fopa_guest' => Yii::$app->user->identity->usua_codi]);
    } 
    

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'fopa_data' => $this->fopa_data,
            'fopa_stat' => $this->fopa_stat,
        ]);


        return $dataProvider;
    }
}
