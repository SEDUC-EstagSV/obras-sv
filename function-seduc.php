<?php


function redirecionamentoPorAutoridade($nivelAutoridade)
{

    if (!isset($_SESSION["user"][1]))
        echo "<script>window.location.replace('index.php')</script>";

    if ($_SESSION["user"][1] < $nivelAutoridade && isset($_SESSION["user"][1])) {
        echo "<script>window.location.replace('painel.php')</script>";
    }
}

function liberaFuncaoParaAutoridade($nivelAutoridade)
{
    if ($_SESSION["user"][1] == 10) return true;

    $libera = $_SESSION["user"][1] >= $nivelAutoridade && isset($_SESSION["user"][1]);

    return $libera;
}

function liberaFuncaoApenasParaAutoridade($nivelAutoridade)
{
    if ($_SESSION["user"][1] == 10) return true;

    $libera = $_SESSION["user"][1] == $nivelAutoridade && isset($_SESSION["user"][1]);

    return $libera;
}

function verificaPasta($dirpath, $mode = 0777)
{
    return is_dir($dirpath) || mkdir($dirpath, $mode, true);
}

function criaLogErro($erro)
{
    $caminho = "./Log/";
    $dayFile = (new DateTime())->setTimezone(new DateTimeZone('America/Sao_Paulo'))->format('Y-m-d');
    $hourFile = (new DateTime())->setTimezone(new DateTimeZone('America/Sao_Paulo'))->format('H-i-s');
    $content = $erro;

    if (verificaPasta($caminho . $dayFile)) {
        $fp = fopen($caminho . $dayFile . "/{$hourFile}.txt", "w");
    }

    fwrite($fp, $content);
    fclose($fp);
}

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;
//Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\SMTP;

function geraEmail($emailToSend)
{
    require './vendor/autoload.php';
    require './usuario/function-usuario.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    //varivel para verificar envio
    class EmailEnviado
    {
        public bool $enviado;
        public string $msg;
    }

    $emailEnviado = new EmailEnviado();

    //gerar um numero aleatorio
    $codigo = rand(1000, 9999);

    //mandar email (verificar se funciona em produção)
    $mail = new PHPMailer();
    $mail->isSMTP();
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->CharSet = 'UTF-8';
    $mail->AuthType = 'XOAUTH2';

    $email = $_ENV['EMAIL'];
    $clientId = $_ENV['CLIENT_ID'];
    $clientSecret = $_ENV['CLIENT_SECRET'];
    $refreshToken = $_ENV['REFRESH_TOKEN'];

    $provider = new Google(
        [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]
    );

    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email,
            ]
        )
    );

    $mail->addAddress($emailToSend);
    $mail->Subject = 'Recuperação de senha em SEDUC Obras';
    $mail->Body = "Seu código para definir uma nova senha é $codigo";


    //buscar usuario
    global $conn;
    try {
        $sql = $conn->prepare("SELECT cd_Usuario FROM usuario WHERE user_Email = ?");
        $sql->bind_param('s', $emailToSend);
        $sql->execute();

        $res = $sql->get_result();
        $row = $res->fetch_object();
        $userId = $row->cd_Usuario;
        if ($userId == null) {
            $emailEnviado->enviado = false;
            $emailEnviado->msg = "<script>alert('Usuário não encontrado');
            window.history.go(-1);</script>";
            return $emailEnviado;
        }
    } catch (mysqli_sql_exception $e) {
        $emailEnviado->enviado = false;
        $emailEnviado->msg = "<script>alert('Ocorreu um erro interno e não foi possível verificar seu email');</script>";
        criaLogErro($e);
        return $emailEnviado;
    }

    //criptografar
    $encryptCodigo = encryptSenha($codigo);


    //expira ultima requisição
    try {
        $sqlExpireLast = $conn->prepare("UPDATE pedido_recuperacao SET ds_ativo = ? 
            WHERE cd_pedido_recuperacao = (SELECT cd_pedido_recuperacao 
            FROM pedido_recuperacao WHERE cd_Usuario = ?
            ORDER BY dt_pedido_recuperacao DESC LIMIT 1)");
        $setExpired = 0;
        $sqlExpireLast->bind_param('ii', $setExpired, $userId);
        $sqlExpireLast->execute();
    } catch (mysqli_sql_exception $e) {
        criaLogErro($e);
    }

    //salvar valor em uma tabela para futura comparação (criar pagina para realizar comparação)
    try {
        $sql = $conn->prepare("INSERT INTO pedido_recuperacao (cd_Usuario, num_pedido_recuperacao, dt_pedido_recuperacao, hr_expiracao_pedido_recuperacao) 
        VALUES (?,?,?,?)");
        date_default_timezone_set('America/Sao_Paulo');
        $tempoParaExpirar = strtotime("+1 Minutes");
        $tempoExpiracao = date("Y-m-d h:i:sa", $tempoParaExpirar);
        $dataAtual = date("Y/m/d h:i:sa");
        $sql->bind_param('isss', $userId, $encryptCodigo, $dataAtual,   $tempoExpiracao);
        $res = $sql->execute();

        if ($res == false) {
            $emailEnviado->enviado = false;
            $emailEnviado->msg = "<script>alert('Não foi possível realizar a solicitação de recuperação. Se o erro persistir entre em contato com o suporte.');
            window.history.go(-1);</script>";
            return $emailEnviado;
        }
    } catch (mysqli_sql_exception $e) {
        $emailEnviado->enviado = false;
        $emailEnviado->msg = "<script>alert('Ocorreu um erro interno. Se o erro persistir entre em contato com o suporte.');window.history.go(-1);</script>";
        criaLogErro($e);
        return $emailEnviado;
    }

    //envia o email e checa erro
    if (!$mail->send()) {
        $emailEnviado->enviado = false;
        $emailEnviado->msg = '<script>alert(Ocorreu um erro ao enviar um email. Se o erro persistir entre em contato com o suporte.);window.history.go(-1);</script>';
        //. $mail->ErrorInfo;
        return $emailEnviado;
    } else {
        $emailEnviado->enviado = true;
        $emailEnviado->msg = "<script>alert(Mensagem enviada para seu email $emailToSend);window.history.go(-1);</script>";
        return $emailEnviado;
    }
}
