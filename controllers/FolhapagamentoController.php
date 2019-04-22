<?php

namespace app\controllers;
use Yii;
use app\models\FolhaPagamento;
use app\models\FolhaPagamentoSearch;
use app\models\Usuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\components\Email;



 class FolhapagamentoController extends Controller
 {
    public function behaviors()
    {
        if (Usuario::find()->where(['usua_codi' => Yii::$app->user->identity->usua_codi, 'usua_nivel' => '98'])->exists()) {
         return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['create', 'delete', 'update', 'view','index','email'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];

        }   
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['create', 'delete', 'update', 'view', 'index'],
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
   /* public function actionCreate()
    {
        $model = new FolhaPagamento();

        if ($model->load(Yii::$app->request->post())) {
            //var_dump($model);
            //die('sd');
            
                //pega o arquivo
                $arquivo = UploadedFile::getInstance($model, 'fopa_arquivo');

                // Cria uma pasta dentro de WEB uploads e dentro folha
                 $upload = new Upload(\Yii::getAlias('@webroot') . '/uploads/folha/');

                // SALVA O ARQUIVO 
                ($upload->File($arquivo));

                //Aqui o metodo verifica se o arquivo ou processo foi com sucesso
                if (!$upload->getResult()) {
                    throw new Exception("Erro ao salvar folha" . $upload->getError());
                }


                // Aqui é o nome tratado pronto para ser gravado no banco 
                $model->fopa_arquivo = '/uploads/folha/' . $upload->getResult();
                $model->fopa_usua = Yii::$app->user->identity->usua_codi;

                //$model->fopa_stat = 0;
                if ($model->save())   {

                return $this->redirect(['view', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua]);
                }
            
        }
        return $this->render('create', [
            'model' => $model,
        ]);


    }
    public function actionUpdate($fopa_codi, $fopa_usua)
    {
        $model = $this->findModel($fopa_codi, $fopa_usua);
        if ($model->load(Yii::$app->request->post())) {

                //pega o arquivo
                $arquivo = UploadedFile::getInstance($model, 'fopa_arquivo');

                // Cria uma pasta dentro de WEB uploads e dentro folha
                $upload = new Upload(\Yii::getAlias('@webroot') . '/uploads/folha/');

                // SALVA O ARQUIVO 
                ($upload->File($arquivo));

                //Aqui o metodo verifica se o arquivo ou processo foi com sucesso
                if (!$upload->getResult()) {
                    throw new Exception("Erro ao salvar folha" . $upload->getError());
                }
                // Aqui é o nome tratado pronto para ser gravado no banco 
                $model->fopa_arquivo = '/uploads/folha/' . $upload->getResult();
                $model->fopa_usua = Yii::$app->user->identity->usua_codi;

            if  ($model->save()) {
                    return $this->redirect(['view', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua]);
                }

            }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($fopa_codi, $fopa_usua)
    {
        $this->findModel($fopa_codi, $fopa_usua)->delete();
        return $this->redirect(['index']);
    }
    */

    public function actionAprovar($id) {
        $model = FolhaPagamento::find()->where(['fopa_codi'=>$id])->one();
        if ($model) {   
            $model->fopa_stat = 1;
            $model->save();
            Yii::$app->getSession()->setFlash('folhaSucesso', "Colaborador: <b>" . FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome . "</b> | Folha referente: <b> $model->fopa_data </b><p> Aprovada com sucesso!");
            return $this->redirect('index');
        }


    }

    public function actionReprovar($id) {
        $model = FolhaPagamento::find()->where(['fopa_codi'=>$id])->one();
        if ($model) {   
            $model->fopa_stat = 2;
            $model->save();
            Yii::$app->getSession()->setFlash('folhaErro', "Folha de <b> $model->fopa_usua </b> foi Reprovada :( ");
        return $this->redirect('index');
        }
        

    }
    public function actionDownload($id)
    {
        $model = FolhaPagamento::find()->where(['fopa_codi' => $id])->one();
        if($model){
            return "<a href='" . Yii::getAlias('@web') . $model['fopa_arquivo'] . "'></a>";
        }
        
    }
    
    protected function findModel($fopa_codi, $fopa_usua)
    {
        if (($model = FolhaPagamento::findOne(['fopa_codi' => $fopa_codi, 'fopa_usua' => $fopa_usua])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Oppss... não encontramos o que procurava :(.');
    }
    public function actionEmail() {
        $sendMail = new Email();
        $remetente = ['andre.juliano@colaborativa.co' => 'André']; //Só um índice
        $destinatario = ['carlos.santos@colaborativa.tv' => 'Carlos Colaborativa', 'andre.juliano@colaborativa.co' => 'André']; // Um ou mais índices de e-mails. Entendeu? entendi
        $assunto = 'Assunto do email';
        $nomeLayout = 'default'; //Nome do arquivo criado na raiz da pasta mail
        $usarTemplate = false; // ou false
        $corpoEmail = '<p style="color:#069;font-size:150px;">'. Yii::$app->request->post('motivo').'</p>';
        $copiaOculta = false; // ou true
        $params = ['titulo' => 'PNM']; //Array de parametros para usar no template.

        $sendMail->sendEmail($remetente, $destinatario, $assunto, $nomeLayout, $usarTemplate, $corpoEmail, $copiaOculta, $params);
        if ($sendMail->getResult()) {
            $retorno = ['success'=>true, 'mensagem'=> $sendMail->getError()];
        } else {
            $retorno = ['success' => false, 'mensagem' => $sendMail->getError()];
        }
      return json_encode($retorno);
    }
}