<?php

namespace app\controllers;

use Yii;
use app\models\FolhaPagamento;
use app\models\FolhaPagamentoSearch;
use app\models\Usuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use app\components\Email;
use yii\helpers\Html;
use yii\helpers\VarDumper;



class FolhapagamentoController extends Controller
{
    public function behaviors()
    {
        if (Yii::$app->user->identity) {
            if (Usuario::find()->where(['usua_codi' => Yii::$app->user->identity->usua_codi, 'usua_nivel' => '98'])->exists()) {
                return [
                    'access' => [
                        'class' => AccessControl::classname(),
                        'only' => ['view', 'index', 'reprovar-folha', 'download'],
                        'rules' => [
                            [
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                        ],
                    ],
                ];
            }
        }
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['', 'aprovar-folha', 'reprovar-folha', 'view', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [''],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new FolhaPagamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($fopa_codi, $fopa_usua)
    {
        return $this->render('view', [
            'model' => $this->findModel($fopa_codi, $fopa_usua),
        ]);
    }

    /**
     aprova folha, envia e-mail para os usuario e gestor logado, altera status da folha no bd
    */
    public function actionAprovar()
    {
        $id = trim(Yii::$app->request->get('id'));
        /*var_dump(Yii::$app->request->get());
        die('teset'); */
        $model = FolhaPagamento::find()->where(['fopa_codi' => $id])->one();
        if ($model) {
            $model->fopa_stat = 1;
            $model->save();
            Yii::$app->getSession()->setFlash('folhaSucesso', "Folha do Colaborador: <b>" . FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome . "</b> | Mês de Referencia: <b> $model->fopa_data </b><p> Aprovada com sucesso!");
        }
        //se for vazio nao dispara email, assim evbita erro
        $email_destinatario = trim(Yii::$app->request->get('email'));
        $email_gestor = trim(Yii::$app->request->get('emailgestor'));

        /*  return json_encode(['success' => false, 'mensagem' => "Error ao aprovar folha.  Entre em contato informadno  codigo 2404 "]); */
        echo "Error ao aprovar folha.  Entre em contato informadno  <b> codigo 2404 </b>";

        $sendMail = new Email();
        $remetente = ['andrejulianom@gmail.com' => 'Informe - SigFolha']; //Só um índice
        $destinatario = [$email_destinatario => null, $email_gestor]; // Um ou mais índices de e-mails
        $assunto = 'Folha aprovada: ' . FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome . ' - Studiorama';
        $nomeLayout = 'default'; //Nome do arquivo criado na raiz da pasta mail
        $usarTemplate = false; // ou false
        $corpoEmail = '<p style="color:black;font-size:14px;font-family:verdana;">' . 'Olá, ' . FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome . '. <br>' . '<p style="color:MediumSeaGreen;font-size:14px;font-family:verdana;">' . 'Sua folha de ponto foi aprovada com sucesso. ' . '<br>' .
            'Matrícula: <b>' . FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_insc . '</b><br>' .
            'Mês de Referência: <b>' . $model->fopa_data . '</b><br>' .
            'Gestor Responsável: <b>' . FolhaPagamento::nomeGestorf($model['fopa_guest'])->usua_nome .
            '</b><br><br>' . 'Folha disponivel no link abaixo:' . '<style="color:Tomato;font-size:16px;font-family:verdana;">' . '<br>'
            .
            Html::a('Download', [Yii::getAlias('@web' . $model->fopa_arquivo)]) .
            '<p><br><hr>' . '<style="color:black;font-size:11px;font-family:verdana;">' . "Mensagem enviada automaticamente, por favor não responda a este e-mail. <br>" . " Se necessário entre em contato com seu Gestor. Para maiores informações, acesse:" . '<br>' . "www.sigfolha.com.br";
        $copiaOculta = false; // ou true
        $params = ['titulo' => 'SigFolha']; //Array de parametros para usar no template.

        $sendMail->sendEmail($remetente, $destinatario, $assunto, $nomeLayout, $usarTemplate, $corpoEmail, $copiaOculta, $params);
        if ($sendMail->getResult()) {

            Yii::$app->getSession()->setFlash('folhaSucesso', "Folha do Colaborador: <b>" . FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome . "</b> | Mês de Referencia: <b> $model->fopa_data </b><p> Aprovada com sucesso!");
        } else {
            $retorno = ['success' => false, 'mensagem' => $sendMail->getError()];
        }

        return $this->redirect(['index']);
        //$this->redirect(Yii::getAlias('@web') . '/folhapagamento/index');
    }

    public function actionReprovarFolha()
    {
        $idfolha = trim(Yii::$app->request->post('id'));
        $model = FolhaPagamento::find()->where(['fopa_codi' => $idfolha])->one();
        if ($model) {
            $model->fopa_stat = 2;
            $model->save();
        }
        //se for vazio no dispara email, assim evbita erro
        $email_destinatario = trim(Yii::$app->request->post('usua_mail'));
        if (empty($email_destinatario)) {
            return json_encode(['success' => false, 'mensagem' => "Error ao reprovar folha.  Entre em contato informadno  código 2404."]);
        }
        $sendMail = new Email();
        $remetente = ['andrejulianom@gmail.com' => 'Informe - SigFolha']; //Só um índice
        $destinatario = [$email_destinatario => null]; // Um ou mais índices de e-mails. Entendeu? entendi
        $assunto = 'Folha Reprovada: ' . FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome . ' - Studiorama';
        $nomeLayout = 'default'; //Nome do arquivo criado na raiz da pasta mail
        $usarTemplate = false; // ou false
        $corpoEmail = '<p style="color:black;font-size:14px;font-family:verdana;">' . 'Olá, ' . FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome . '. <br>' . 'Sua folha de ponto foi reprovada, pelo seguinte motivo.' .  
            '<p style="color:Tomato;font-size:15px;font-family:verdana;">' . Yii::$app->request->post('motivo') .           '<p style="color:black;font-size:14px;font-family:verdana;">' .
            'Mês de Referência: <b>' . $model->fopa_data . '</b><br>' .
            'Gestor Responsável: <b>' . FolhaPagamento::nomeGestorf($model['fopa_guest'])->usua_nome . '</b><br>' .
        '</b><br><p style="color:black;font-size:9px;font-family:verdana;">' . '<hr>' . '<style="color:black;font-size:11px;font-family:verdana;">' . "Mensagem enviada automaticamente, por favor não responda a este e-mail. <br>" . " Se necessário entre em contato com seu Gestor. Para maiores informações, acesse:" . '<br>' . "www.sigfolha.com.br";
        $copiaOculta = false; // ou true
        $params = ['titulo' => 'SigFolha']; //Array de parametros para usar no template.

        $sendMail->sendEmail($remetente, $destinatario, $assunto, $nomeLayout, $usarTemplate, $corpoEmail, $copiaOculta, $params);
        if ($sendMail->getResult()) {
            $retorno = ['success' => true, 'mensagem' => $sendMail->getError()];
        } else {
            $retorno = ['success' => false, 'mensagem' => $sendMail->getError()];
        }
        //return Yii::$app->request->redirect();
        return json_encode($retorno);
    }

    //forca o download do arquivo, desde que o navegador nao tenha um bloqueador de downloads
       public function actionDownload($id)
    {
        $model = FolhaPagamento::find()->where(['fopa_codi' => $id])->one();
        $path = Yii::getAlias('@webroot')  . $model['fopa_arquivo'];
        $file = $path; 
        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        }
    }

    protected function findModel($fopa_codi, $fopa_usua)
    {
        if (($model = FolhaPagamento::findOne(['fopa_codi' => $fopa_codi, 'fopa_usua' => $fopa_usua])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Oppss... não encontramos o que procurava :(.');
    }
}
