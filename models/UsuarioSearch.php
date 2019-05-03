<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;
use app\models\GestorUsuario;

/**
 * UsuarioSearch represents the model behind the search form of `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usua_codi', 'usua_nivel'], 'integer'],
            [['usua_nome', 'usua_dins', 'usua_pass', 'usua_hash', 'usua_foto', 'usua_logi', 'usua_insc','usua_ngest'], 'safe'],
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
        if (Usuario::find()->where(['usua_codi' => Yii::$app->user->identity->usua_codi, 'usua_nivel' => '98', 'usua_ngest' =>'1755'])->exists()) {
            $query = Usuario::find();
   /*          var_dump($query);
            die('sts'); */
        } else {
            $query = Usuario::find()->where(['usua_guest' => Yii::$app->user->identity->usua_codi]);
            //  $query = Usuario::find()->where([ 'usua_codi' => Yii::$app->user->identity->usua_codi]);
        }


        //$query = Usuario::find();

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

            'usua_dins' => $this->usua_dins,
            'usua_nivel' => $this->usua_nivel,
            'usua_guest' => $this->usua_guest,
        ]);

        $query->andFilterWhere(['like', 'usua_nome', $this->usua_nome])
            ->andFilterWhere(['like', 'usua_pass', $this->usua_pass]);
        //->andFilterWhere(['like', 'usua_mail', $this->usua_mail])          
        //  ->andFilterWhere(['like', 'usua_logi', $this->usua_logi]);

        return $dataProvider;
    }
}
