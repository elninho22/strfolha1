<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\assets\AppAsset;
use app\models\FolhaPagamento;
use app\models\PagamentoUtil;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaPagamento */

//$this->title = 'Folha : '; // . FolhaPagamento::nomeUsuario('fopa_usua')->modal->usua_nome;//return FolhaPagamento::nomeUsuario($model['fopa_codi'])->usua_nome;,

$this->params['breadcrumbs'][] = ['label' => 'Gerencial', 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

//var_dump($url);
//die('4');
?>
<div class="folha-pagamento-view">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo ''
        ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fopa_codi',
            [
                'attribute' => 'fopa_usua',
                'value' => function ($model) {
                    return FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome;
                }
            ],
            'fopa_data', // mes de referencia na TABELA
            [
                'attribute' => 'fopa_arquivo',
                //'label' => 'fopa_arquivo',
                'format' => 'raw',
                'value'  => function ($model) {
                    return "<a href='" . Yii::getAlias('@web') . $model['fopa_arquivo'] . "'>Visualizar</a>";
                }
            ],
            //'fopa_arquivo',
            'fopa_text',
            [
                'fopa_dins',
                'attribute' => 'fopa_dins',
                'label' => 'Data de Envio',
            ],

            //'attribute' => 'fopa_stat',
            //'format' => 'raw',
            //'label' =>   
            [
                'attribute' => 'fopa_stat',
                'format' => 'raw',
                'value' => function ($model) {
                    //return PagamentoUtil::getStatusValue($model[$data->fopa_stat]);
                    return $model['fopa_stat'] == 0 ? 'Pendente' : ($model['fopa_stat'] == 1 ? 'Aprovado' : 'Reprovado');
                }
            ],
        ],
    ]) ?>

</div>