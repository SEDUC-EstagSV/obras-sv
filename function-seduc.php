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

/*
function geraEmail($cd_Usuario, $email){
    //require('./usuario/function-usuario.php');
    //require('config.php');

    //tem que gerar um numero aleatorio
    $codigo = rand(1000, 9999);

    //tem que criptografar de alguma forma
    //$encryptCodigo = encryptSenha($codigo);

  
    //salvar valor em uma tabela para futura comparação (criar pagina para realizar comparação)
    $sql = $conn->prepare("INSERTO INTO pedido_recuperacao_senha (cd_Usuario, num_pedido) 
                            VALUES (?,?)");
    $sql->bind_param('is', $cd_Usuario, $encryptCodigo);
    $sql->execute();
  

    //mandar email (ainda não funciona em ambiente de teste)
    $to = $email;   
    $subject = "Recuperação de senha";
    $message = "Seu código para definir uma nova senha é $codigo";

    $emailEnviado = mail($to, $subject, $message);
    var_dump($emailEnviado);
    var_dump($to);  
    var_dump($subject);
    var_dump($message);
}
*/
