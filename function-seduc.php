<?php

function formatarAutoridade($user_Autoridade)
{

    if ($user_Autoridade == 1) {
        $user_Autoridade = 'Pendente';
    } else if ($user_Autoridade == 2) {
        $user_Autoridade = 'Subordinado';
    } else if ($user_Autoridade == 3) {
        $user_Autoridade = 'Supervisor';
    } else if ($user_Autoridade == 4) {
        $user_Autoridade = 'Secretária';
    } else if ($user_Autoridade == 10) {
        $user_Autoridade = 'Admin';
    } else
        $user_Autoridade = 'A definir';

    return $user_Autoridade;
}

function formatarRelatorioSit($situacao)
{

    if ($situacao == 1) {
        $situacao = 'Pendente';
    } else if ($situacao == 2) {
        $situacao = 'Recusado';
    } else if ($situacao == 3) {
        $situacao = 'Aprovado';
    } else
        $situacao = 'A definir';

    return $situacao;
}

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

/*
function geraEmail(){
    //tem que gerar um numero aleatorio
    $codigo = rand(1000, 9999);

    //tem que criptografar de alguma forma


    //mandar email (ainda não funciona)
    ini_set("SMTP","tsl://smtp.gmail.com");
    ini_set("smtp_port","587");
    ini_set("sendmail_from","pmsvtec@gmail.com");
    ini_set("sendmail_path", "C:/xampp/sendmail/sendmail.exe -t");

    $to = "ga.ferreira.desouza@gmail.com";
    $subject = "Recuperação de senha";
    $message = "Seu código para definir uma nova senha é {$codigo}";

    mail($to, $subject, $message);
}
*/
