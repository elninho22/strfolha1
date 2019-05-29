<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\AppAsset;
use app\models\FolhaPagamento;

$this->title = 'Gerencial - Folha de Ponto';
$this->registerJsFile("@web/js/index.js", [
    'depends' => AppAsset::className(),
]);
$this->registerJsFile("@web/js/aprov.js", [
    'depends' => AppAsset::className(),
]);
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folha-pagamento-index">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php
        if (Yii::$app->session->hasFlash('folhaSucesso')) {
            echo '<div class="alert alert-success" role="alert">
            ' . Yii::$app->session->getFlash('folhaSucesso') . '
          </div>';
        } elseif (Yii::$app->session->hasFlash('folhaErro')) {
            echo '<div class="alert alert-danger" role="alert">' . Yii::$app->session->getFlash('folhaErro') . '
          </div>';
        }
        ?>
    </p>

    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'fopa_usua',
                    'value' => function ($model) {
                        return FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome;
                    }
                ],
                [
                    'attribute' => 'fopa_data',
                    'filter' => ['Janeiro' => 'Janeiro', 'Fevereiro' => 'Fevereiro', 'Março' => 'Março', 'Abril' => 'Abril', 'Maio' => 'Maio', 'Junho' => 'Junho', 'Julho' => 'Julho', 'Agosto' => 'Agosto', 'Setembro' => 'Setembro', 'Outubro' => 'Outubro', 'Novembro' => 'Novembro', 'Dezembro' => 'Dezembro'],
                ],
                [
                    'attribute' => 'fopa_stat',
                    'headerOptions' => ['class' => 'text-center', 'style' => 'width: 10%;'],
                    'format' => 'raw',
                    'filter' => ['1' => 'Aprovado', '2' => 'Reprovado', '0' => 'Pendente'],
                    'value' => ['app\models\PagamentoUtil', 'getStatusValue'],
                ],
                [
                    'attribute' => 'fopa_text',
                    'format' => 'raw',
                    'header' => 'Observação',
                    'headerOptions' => ['class' => 'text-center'],
                ],
                [
                    'header' => 'Folha',
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['class' => 'text-center'],
                    'template' => "{view}",
                    'contentOptions' => ['class' => 'text-center'],
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                'Download',
                                ['download', 'id' => $model->fopa_codi],
                                [
                                    'class' => 'btn btn-default',
                                    // 'url' => $url
                                ]
                            );
                        },
                    ],
                ],
                [
                    'header' => 'Opções',
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['class' => 'text-center', 'style' => 'width: 30%;'],
                    'contentOptions' => ['class' => 'text-center'],
                    'template' => "{view} {update} {delete}", // altera a forma de exibição dos botões
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                'Aprovar',
                                [
                                    'aprovar', 'id' => $model->fopa_codi, 'email' => FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_mail, FolhaPagamento::linkArq($model['fopa_arquivo'])->fopa_arquivo,
                                    $model->fopa_data,
                                    FolhaPagamento::nomeGestorf($model['fopa_guest'])->usua_nome,
                                    'emailgestor' => FolhaPagamento::emailGestor($model['fopa_guest'])->usua_mail,
                                ],
                                [
                                    'class' => 'btn btn-success',
                                    'title' => 'Aprovar Folha',
                                    'data' => [
                                        'confirm' => "Aprovar folha do colaborador: " .  FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome . " ? ",
                                        'method' => 'post',
                                    ],
                                    'id' => 'load',
                                    'data-loading-text' => '<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"> </i> Aguarde...',
                                ]
                            );
                        },
                        'update' => function ($url, $model) {
                            return '<button type="button" id="' . FolhaPagamento::idFolhaPagamento($model['fopa_codi'])->fopa_codi . '" data-usuario="' . FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_mail . '" class="btn btn-danger reprovar-user"  title="Reprovar Folha">Reprovar</button>';
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('Visualizar', ['view', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua], [
                                'class' => 'btn btn-primary',
                                "title" => 'Visualizar Folha',
                            ]);
                        },
                    ],
                ],
            ],
        ]
    ); ?>
</div>

<?= $this->render('_modals') ?>