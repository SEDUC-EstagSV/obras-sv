<?php

//validação de cadastro 
function cadastraval($login, $senha, $senha2, $nome, $cpf, $email, $telefone)
{

    //validar campos se estão preenchidos
    if (!$login || !$senha || !$senha2 || !$nome || !$cpf || !$email || !$telefone) {
        print "<p class='alert alert-danger'>Preencha todos os campos!</p>";
        exit;
    }
    //validar email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    } else {
        print "<p class='alert alert-danger'>E-mail invalido!</p>";
        exit;
    }
}


//validação do CPF
function validaCPF($cpf)
{

    $cpf = preg_replace('/[^0-9]/is', '', $cpf);
    $erro = true;

    if (strlen($cpf) != 11) {
        $erro = false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        $erro = false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            $erro = false;
        }
    }
    if ($erro == false) {
        print "<p class='alert alert-danger'>CPF invalido!</p>";
        exit;
    }
    return $cpf;
}


//Confirma se as duas senhas são iguais
function confirmarsenha($senha, $senha2)
{

    if ($senha != $senha2) {
        print "<p class='alert alert-danger'>Senhas não são iguais!</p>";
        exit;
    }
}


//valida login
function loginval($login, $senha)
{

    //validar campos se estão preenchidos
    if (!$login || !$senha) {
        print "<p class='alert alert-danger'>Preencha todos os campos!</p>";
        exit;
    }
}


//valida as edições
function editarval($login, $user_SenhaAntiga, $senha, $senha2, $nome, $user_Autoridade, $email, $telefone)
{

    //validar campos se estão preenchidos
    if (!$login || !$user_SenhaAntiga || !$senha || !$senha2 || !$nome || !$user_Autoridade || !$email || !$telefone) {
        print "<p class='alert alert-danger'>Preencha todos os campos!</p>";
        exit;
    }
}


//filtro de login com base na autoridade atribuida
function loginAutoridade($autoridade)
{
    switch ($autoridade) {

            //esperando confirmação do cadastro
        case 1:
            print "<script>alert('Esperando liberação');</script>";
            include("usuario/logout-usuario.php");
            print "<script>location.href='index.php';</script>";
            break;
            //Usuário subordianado
        case 2:
            print "<script>alert('Logado{$_SESSION["user"][0]}');</script>";
            print "<script>location.href='painel.php';</script>";
            break;

            //Supervisão 
        case 3:
            print "<script>alert('Logado como Supervisor');</script>";
            print "<script>location.href='painel.php';</script>";
            break;

            //Secretária
        case 4:

            print "<script>alert('Logado como Secretária');</script>";
            print "<script>location.href='painel.php';</script>";
            break;

            //Devs
        case 10:

            print "<script>alert('Logado como Administrador');</script>";
            print "<script>location.href='painel.php';</script>";
            break;
    }
}


//valida o gerenciamento de usuario 
function gerenciarval($login, $nome, $user_Autoridade, $email, $telefone)
{

    //validar campos se estão preenchidos
    if (!$login || !$nome || !$user_Autoridade || !$email || !$telefone) {
        print "<p class='alert alert-danger'>Preencha todos os campos!</p>";
        exit;
    }
}


//valida a recuperação de senha do usuario
function recuperarval($login, $senha1, $senha2)
{
    //validar campos se estão preenchidos
    if (!$login || !$senha1 || !$senha2) {
        print "<p class='alert alert-danger'>Preencha todos os campos!</p>";
        exit;
    }
}

function encryptSenha($senha){
    return password_hash($senha, PASSWORD_BCRYPT);
}