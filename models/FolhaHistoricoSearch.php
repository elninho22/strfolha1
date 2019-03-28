<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FolhaHistorico;

/**
 * FolhaHistoricoSearch represents the model behind the search form of `app\models\FolhaHistorico`.
 */
class FolhaHistoricoSearch extends FolhaHistorico
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fohi_codi', 'fopa_fopa'], 'integer'],
            [['fohi_data', 'fohi_text', 'fohi_arq'], 'safe'],
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
        $query = FolhaHistorico::find();

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
            'fohi_codi' => $this->fohi_codi,
            'fohi_data' => $this->fohi_data,
            'fopa_fopa' => $this->fopa_fopa,
        ]);

        $query->andFilterWhere(['like', 'fohi_text', $this->fohi_text])
            ->andFilterWhere(['like', 'fohi_arq', $this->fohi_arq]);

        return $dataProvider;
    }
}
