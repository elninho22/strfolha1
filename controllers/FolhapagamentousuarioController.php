<?php

namespace app\controllers;
use Yii;
use app\models\FolhaPagamentoUsuario;
use app\models\FolhaPagamentoUsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\GestorUsuario;
use app\components\Upload;
use app\components\Uteis;


 
 
 class FolhapagamentousuarioController extends Controller
 {
    public function behaviors()
    {
        if (!Usuario::find()->where(['usua_codi' => Yii::$app->user->identity->usua_codi, 'usua_nivel' => '99'])->exists()) {

            return [
                'access' => [
                    'class' => AccessControl::classname(),
                    'rules' => [
                        [
                            'actions' => ['create','update', 'view', 'index'],
                            'allow' => true,
                            'roles' => [''],
                            
                        ],  
                    ],
                ],
            ];
            ;
        }
        
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {


        $searchModel = new FolhapagamentoUsuarioSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,

            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($fopa_codi, $fopa_usua)
    {
        if (Yii::$app->user->identity->usua_nivel != 98) { // se for diferente do admin é usuario
            // VarDumper::dump(Yii::$app->user->identity->usua_codi, 10, true);
            // die('oi');
            if (Yii::$app->user->identity->usua_codi != $fopa_usua) { // ID do usuário é diferente da sessão

                throw new NotFoundHttpException("Ops . . . não encontramos o que procurava :( " . "Entre em contato com suporte informando código: 0937");
            }
        }
        return $this->render('view', [
            'model' => $this->findModel($fopa_codi, $fopa_usua),
        ]);

    }

    public function actionCreate()
    {
        $model = new FolhapagamentoUsuario();

        if ($model->load(Yii::$app->request->post())) {
            //var_dump($model);
            //die('sd');
            
            //pega o arquivo
            $arquivo = UploadedFile::getInstance($model, 'arquivo');
            // Cria uma pasta dentro de WEB uploads e dentro folha
            $upload = new Upload(\Yii::getAlias('@webroot') . '/uploads/folha/');

            // pegando extensao do arquivo$ex = $arquivo->extension; e verifica em qual metodo vai tratar
            if( $arquivo->extension == 'pdf'){
                $upload->File($arquivo);
            }else{
                $upload->Image($arquivo);
            }

            //Aqui o metodo verifica se o arquivo ou processo foi com sucesso
            $model->fopa_arquivo = '/uploads/folha/' . $upload->getResult();
            
            // depuracao: \yii\helpers\VarDumper::dump( $model,10,true); die('o');
            // if (!$upload->getResult()) {
            // caso de erro     throw new Exception("Erro ao salvar folha" . $upload->getError());
            // }

             $model->fopa_usua = Yii::$app->user->identity->usua_codi;

            // SALVA O ARQUIVO           
            if ($model->save())   {
                return $this->redirect(['view', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua]);
                }
           // depuracao \yii\helpers\VarDumper::dump( $model->errors,10,true); die('o');
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    public function actionUpdate($fopa_codi, $fopa_usua)
    {
        if (Yii::$app->user->identity->usua_nivel != 98) { // se for diferente do admin é usuario
            // VarDumper::dump(Yii::$app->user->identity->usua_codi, 10, true);
            // die('oi');
            if (Yii::$app->user->identity->usua_codi != $fopa_usua) { // ID do usuário é diferente da sessão

                throw new NotFoundHttpException("Ops . . . não encontramos o que procurava :( " . "Entre em contato com suporte informando código: 0937");
            }
        }
        $model = $this->findModel($fopa_codi, $fopa_usua);
        if ($model->load(Yii::$app->request->post())) {

            //pega o arquivo
            $arquivo = UploadedFile::getInstance($model, 'arquivo');
            // Cria uma pasta dentro de WEB uploads e dentro folha
            $upload = new Upload(\Yii::getAlias('@webroot') . '/uploads/folha/');

            // pegando extensao do arquivo$ex = $arquivo->extension; e verifica em qual metodo vai tratar
            if ($arquivo->extension == 'pdf') {
                $upload->File($arquivo);
            } else {
                $upload->Image($arquivo);
            }

            //Aqui o metodo verifica se o arquivo ou processo foi com sucesso
            $model->fopa_arquivo = '/uploads/folha/' . $upload->getResult();

            // depuracao: \yii\helpers\VarDumper::dump( $model,10,true); die('o');
            // if (!$upload->getResult()) {
            // caso de erro     throw new Exception("Erro ao salvar folha" . $upload->getError());
            // }

            $model->fopa_usua = Yii::$app->user->identity->usua_codi;     

            //$now = new DateTime();
                $model->fopa_stat = 0;
                $model->fopa_dins = date('Y-m-d H:i:s');
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

    protected function findModel($fopa_codi, $fopa_usua)
    {
        if (($model = FolhapagamentoUsuario::findOne(['fopa_codi' => $fopa_codi, 'fopa_usua' => $fopa_usua])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Oppss... não encontramos o que procurava :(.');
    }
}