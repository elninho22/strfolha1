<?php
use app\models\Usuario;;
use app\assets\AppAsset;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


$this->registerJsFile("@web/js/cadindex.js", [
    'depends' => AppAsset::className(),
]);

$model = new Usuario();
?>


<!-- Modal -->
<div class="modal fade" id="modalCad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

    <div class="modal-dialog form-dark" role="document">
        <!--Content-->
        <div class="modal-content card card-image" style="background-image: url('/strfolha/web/uploads/bts/caduser.jpg');">
            <div class="text-white rgba-stylish-strong py-9 px-9 z-depth-8">
                <!--Header-->
                <div class="modal-header text-center pb-4">
                    <h3 class="modal-title w-100 white-text font-weight-bold" id="myModal"><strong><b>;)</b></strong> <a class="text-primary"><strong>Olá, Visitante | SIGFOLHA</strong></a></h3>
                    <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <!--Body-->
                    <!--Msg de Cadastro-->
                    <div class="msg_ajax"></div>
                    <form id="_cad" method="POST" action="">
                        <div class="md-form mb-12">
                            <label for="nome" class="text-primary bg-dark">Nome Completo</label>
                            <input type="text" name="usua_nome" id="nome" class="form-control" Placeholder="Digite seu Nome">
                            <p>
                        </div>

                        <div class="md-form mb-12">
                            <label for="Form-email5" text-align="left" class="text-primary bg-dark">Matricula</label>
                            <input type="text" name="usua_insc" id="usua_insc" class="form-control" Placeholder="Digite Matricula" maxlength="9">
                            <p>
                        </div>

                        <div class="md-form mb-12">
                            <label for="email" class="text-primary bg-dark">E-mail</label>
                            <input type="email" name="usua_mail" id="usua_mail" class="form-control" Placeholder="Digite seu e-mail">
                            <p>
                        </div>

                        <div class="md-form pb-3">
                            <label for="senha" class="text-primary bg-dark">Senha</label>
                            <input type="password" name="usua_pass" id="usua_pass" class="form-control" Placeholder="Digite senha">
                            <h5><span class="label label-default">Senha deve ter no mínimo 6 digitos <span></h5>
                        </div>
                        <p>
                            <div class="md-form mb-12">
                                <label for="gestor" class="text-primary bg-dark">Gestor</label>
                                <?= Html::dropDownList('usua_guest', null, ArrayHelper::map(Usuario::find()->where(['usua_nivel' => '98'])->all(), 'usua_codi', 'usua_nome'), ['class' => "form-control", 'prompt' => 'Selecione seu Gestor', '<br>']); ?>
                            </div>

                            <!--Grid row-->
                            <div class="row d-flex align-items-center mb-4">
                                <br>
                                <!--Grid column-->
                                <div class="text-center mb-3 col-md-12">
                                    <button type="submit" name="cadastrar" class="btn btn-success btn-block btn-rounded z-depth-1">Cadastrar</button>
                                </div>
                                <!--  <input name="id" val="" id="usua_codi" type="hidden" />
                            Grid column-->

                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">
                            </div>
                            <!--Grid row-->
                    </form>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal -->