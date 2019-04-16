<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaPagamento */

$this->title = 'Referência: ' . $model->fopa_data;
$this->params['breadcrumbs'][] = ['label' => 'Folha de Ponto', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


//var_dump($url);
//die('4');
?>
<div class="folha-pagamento-usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('Editar', ['update', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua], ['class' => 'btn btn-warning']) ?>
    <br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fopa_codi',
            [
                'fopa_usua',
                
            ],
            'fopa_data', // MES DE REFERENCIA NA tabela
            [
                'attribute' => 'fopa_arquivo',
                //'label' => 'fopa_arquivo',
                'format' => 'raw',
                'value'  => function ($model) {
                    return "<a href='" . Yii::getAlias('@web') . $model['fopa_arquivo'] . "'>Baixar</a>";
                }
            ],
            //'fopa_arquivo',
            'fopa_text',
            [
                'fopa_dins',
                'attribute' => 'fopa_dins',
                'label' => 'Data de Envio',
            ],
        ],
    ]) ?>

</div>