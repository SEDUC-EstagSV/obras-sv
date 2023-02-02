<?php


function redirecionamentoPorAutoridade($nivelAutoridade){

    if(!isset($_SESSION["user"][1])) header("location: index.php");
        
    if($_SESSION["user"][1] < $nivelAutoridade && isset($_SESSION["user"][1])){
        header("location: painel.php");
    }
}

function liberaFuncaoParaAutoridade($nivelAutoridade){
    $libera = $_SESSION["user"][1] >= $nivelAutoridade && isset($_SESSION["user"][1]);

    return $libera; 
}

function verificaPasta($dirpath, $mode=0777) {
    return is_dir($dirpath) || mkdir($dirpath, $mode, true);
}

function criaLogErro($erro){
    $caminho = "./Log/";
    $dayFile = (new DateTime())->setTimezone(new DateTimeZone('America/Sao_Paulo'))->format('Y-m-d');
    $hourFile = (new DateTime())->setTimezone(new DateTimeZone('America/Sao_Paulo'))->format('H-i-s');
    $content = $erro;

    if(verificaPasta($caminho . $dayFile)) {
        $fp = fopen($caminho . $dayFile . "/{$hourFile}.txt","w");
    }

    fwrite($fp,$content);
    fclose($fp);
}

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;
//Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;


function geraEmail($emailToSend){
    require './vendor/autoload.php';
    require './usuario/function-usuario.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

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

    $email = "pmsvtec@gmail.com";
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
    try{
        $sql = $conn->prepare("SELECT cd_Usuario FROM usuario WHERE user_Email = ?");
        $sql->bind_param('s', $emailToSend);
        $sql->execute();

        $res = $sql->get_result();
        $row = $res->fetch_object();
        $userId = $row->cd_Usuario;
        if($userId == null) {
            print "<script>alert('Usuário não encontrado');
            window.history.go(-1);</script>";
        }
        
    } catch(mysqli_sql_exception $e){
        print "<script>alert('Ocorreu um erro interno e não foi possível verificar seu email');</script>";
        criaLogErro($e);
        exit();
    }

    //criptografar
    $encryptCodigo = encryptSenha($codigo);
    
    //salvar valor em uma tabela para futura comparação (criar pagina para realizar comparação)
    try{

        $sql = $conn->prepare("INSERT INTO pedido_recuperacao (cd_Usuario, num_pedido_recuperacao) 
        VALUES (?,?)");
        $sql->bind_param('is', $userId, $encryptCodigo);
        $res = $sql->execute();

        if($res == false){
            print "<script>alert('Não foi possível realizar a solicitação de recuperação. Se o erro persistir entre em contato com o suporte.');
            window.history.go(-1);</script>";
        }
    } catch(mysqli_sql_exception $e){
        print "<script>alert('Ocorreu um erro interno. Se o erro persistir entre em contato com o suporte.');window.history.go(-1);</script>";
        criaLogErro($e);
        exit();
    }

    //envia o email e checa erro
    if (!$mail->send()) {
        echo '<script>alert(Ocorreu um erro ao enviar um email. Se o erro persistir entre em contato com o suporte.);window.history.go(-1);</script>';
        //. $mail->ErrorInfo;
    } else {
        echo "<script>alert(Mensagem enviada para seu email $emailToSend);window.history.go(-1);</script>";
    }
}

