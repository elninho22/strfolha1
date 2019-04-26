<?php

/* @var $this yii\web\View */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;



$this->title = 'SigFolha - Studiorama';
?>


<div class="site-index">

  <div class="well" align=" center">
    <h1>Olá, bem vindo!
    </h1>
  </div>

  <div class="row" align="center">
    <h4>Acesse sua conta</h4>
    <div class="col-xs-2 col-md-12"><a class="btn btn-lg btn-success" href="site/login">Entrar</a></div>

    <br><br><br><br>

    <h4 align="center">1º acesso ? Faça seu cadastro!</h4>
    <div class="col-xs-2 col-md-12" align="center">
      <!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
        Cadastre-se</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
      <div class="modal-dialog form-dark" role="document">
        <!--Content-->
        <div class="modal-content card card-image" style="background-image: url('/strfolha/web/uploads/bts/caduser.jpg');">
          <div class="text-white rgba-stylish-strong py-9 px-9 z-depth-8">
            <!--Header-->
            <div class="modal-header text-center pb-4">
              <h3 class="modal-title w-100 white-text font-weight-bold" id="myModal"><strong>CADASTRO</strong> <a class="green-text font-weight-bold"><strong> SIGFOLHA</strong></a></h3>
              <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!--Body-->
            <div class="modal-body">
              <!--Body-->
              <div class="md-form mb-12">
                <label for="nome"><a class="green-text font-weight-bold" text-align:left><strong> Nome Completo</strong></a></label>
                <input type="text" name="usua_nome" id="usua_nome" class="form-control" Placeholder="Digite seu Nome">
                <p>
              </div>
              <div class="md-form mb-12">
                <label data-error="wrong" data-success="right" for="Form-email5" text-align="left"><a class="green-text font-weight-bold" text-align:left><strong>Matricula</strong></a></label>
                <input type="text" name="usuan_insc" id="usuan_insc" class="form-control" Placeholder="Digite Matricula">
                <p>
              </div>

              <div class="md-form mb-12">
                <label for="email"><a class="green-text font-weight-bold" text-align:left><strong>E-mail</strong></a></label>
                <input type="email" name="usua_mail" id="usua_mail" class="form-control" Placeholder="Digite seu e-mail">
                <p>
              </div>

              <div class="md-form pb-3">
                <label for="senha">Senha</label>
                <input type="password" name="usua_pass" id="usua_pass" class="form-control validate white-text">
              </div>

              <div class="md-form mb-12">
                <label for="gestor">Gestor</label>
                <input type="email" name="usua_guest" id="usua_guest" class="form-control" Placeholder="Selecione gestor">
                <p>
              </div>

              <!--Grid row-->
              <div class="row d-flex align-items-center mb-4">

                <!--Grid column-->
                <div class="text-center mb-3 col-md-12">
                  <button type="button" class="btn btn-success btn-block btn-rounded z-depth-1">Cadastrar</button>
                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Grid row-->
              <div class="row">
              </div>
              <!--Grid row-->

            </div>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Modal -->


  </div>
</div>