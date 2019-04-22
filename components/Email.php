<?php

namespace app\components;

use yii\swiftmailer\Mailer;

/**
 * Description of Email
 * <b>No final da classe tem um exemplo. actionEmail</b>
 * @author Carlos Santos
 */
class Email
{

    private $Host;
    private $Port;
    private $Security;
    private $User;
    private $Pass;
    private $EnvioAnexo; //True habilita envio de anexo, false desabilita

    /** RESULTSET */
    private $Result;
    private $Error;

    /** Objeto */
    private $Mailer;

    /**
     * Pode criar um novo objeto ou usar config default. <b>No final da classe tem um exemplo. actionEmail</b>
     * @param string $host - Host smtp.domino.com.br | mail.dominio.com.br | outro
     * @param string $port - Porta do smtp. Exemplo: 587 | 25 | 465 outras
     * @param string $security - O modo de criptografia a ser usado ao usar smtp. Os valores válidos são tls, ssl, ou null.
     * @param string $pass - Senha do SMTP
     * @param string $user - E-mail do SMTP
     * @param string $envioAnexo True para habilitar envio de anexo e default false
     * @return object Retorna instância do objeto
     */
    function __construct($host = null, $port = null, $security = null, $pass = null, $user = null, $envioAnexo = null)
    {
        $config = [
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => $this->Host = isset($host) ? $host : 'smtp.gmail.com',
                'username' => $this->User = isset($user) ? $user : 'webmaster@colaborativa.tv',
                'password' => $this->Pass = isset($pass) ? $pass : 'hcolab!!01',
                'port' => $this->Port = isset($port) ? $port : '465',
                'encryption' => $this->Security = isset($security) ? $security : 'ssl'
            ],
            'useFileTransport' => $this->EnvioAnexo = isset($envioAnexo) ? true : false,
        ];
        $this->Mailer = new Mailer($config);
    }

    /**
     * <b>Envia UM ou MAIS E-Mail's :</b> Envia para muitos destinatários ou um.
     * <b>No final da classe tem um exemplo. actionEmail</b>
     * @param array() $remetente <b>Remetente:</b> <p> O responsável pelo envio será o e-mail configurado do <b>construtor.</b> <br>Exemplo ['destinatario@email.com.br'=>'nome destino']</p>
     * @param array() $destinatario Um ou mais índices no array ['email@email.com.br'=>'nome destino']
     * @param string $assunto Assunto do E-mail
     * @param string $nomeLayout <p><b>Observações </b> Se <b>$usarTemplate</b>for TRUE preencher com nome no template (criado na pasta raiz do mail) caso contrário deixa vazio '' </p>
     * @param string $usarTemplate True ou False
     * @param string $corpoEmail <p>Se <b>$usarTemplate</b> for TRUE deixar vazio '' caso contrário Criar String com formatação em HTML. </p>
     * @param string $copiaOculta <p> <b>TRUE </b> Será enviando para um ou mais destinatários com cópia oculta. </br><b>FALSE </b> Envia para um ou mais destinatários com listagem de todos envolvidos</p>
     * @param array() $params <p>Pode enviar array de params para ultilizar no template ex. ['campanha'=>'Nome da campanha']</p>
     */
    public function sendEmail(array $remetente, array $destinatario, $assunto = null, $nomeLayout = null, $usarTemplate = false, $corpoEmail = null, $copiaOculta = false, $params = [])
    {
        $remetente = count($remetente) > 0 ? $remetente : ['webmaster@colaborativa.tv' => 'Colaborativa'];
        $destinatario = count($destinatario) > 0 ? $destinatario : [];
        $assunto = ((string)$assunto ? $assunto : 'E-mail colaborativa');
        $nomeLayout = ((string)$nomeLayout ? $nomeLayout : 'default');
        $params = count($params) > 0 ? $params : [];

        $sendMail = $this->Mailer->compose($nomeLayout, $params)
            ->setFrom($remetente)
            ->setSubject($assunto);
        $copiaOculta ? $sendMail->setBcc($destinatario) : $sendMail->setTo($destinatario);
        $usarTemplate ?: $sendMail->setHtmlBody($corpoEmail);

        if ($sendMail->send()) {
            $this->Result = true;
            $this->Error = 'E-mail enviado com sucesso!';
        } else {
            $this->Result = false;
            $this->Error = 'E-mail não enviado!';
        }
    }

    /**
     * <b>Verificar o status do E-Mail:</b> Executando um getResult é possível verificar se o E-mail foi enviado ou não. Retorna
     * TRUE ou FALSE.
     * @return boolean  = True ou False
     */
    public function getResult()
    {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com um code, um title, um erro e um tipo.
     * @return ARRAY $Error = Array associatico com o erro
     */
    public function getError()
    {
        return $this->Error;
    }
}

/*
public function actionEmail() {
    $sendMail = new Email();
    $remetente = ['remetente@email.com.br' => 'Colaborativa']; //Só um índice
    $destinatario = ['carlos.santos@colaborativa.tv' => 'Carlos Colaborativa']; // Um ou mais índices de e-mails
    $assunto = 'Assunto do email';
    $nomeLayout = 'campanha-natal'; //Nome do arquivo criado na raiz da pasta mail
    $usarTemplate = true; // ou false
    $corpoEmail = '<p style="color:#069;font-size:150px;">Corpo do email</p>';
    $copiaOculta = false; // ou true
    $params = ['titulo' => 'Campanha promocional de natal']; //Array de parametros para usar no template.

    $sendMail->sendEmail($remetente, $destinatario, $assunto, $nomeLayout, $usarTemplate, $corpoEmail, $copiaOculta, $params);
    if ($sendMail->getResult()) {
        $retorno = $sendMail->getError();
    } else {
        $retorno = $sendMail->getError();
    }
    \yii\helpers\VarDumper::dump($retorno, 10, true);
    die();
}
 */
