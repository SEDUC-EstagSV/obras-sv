<?php
require_once('function-usuario.php');

switch ($_REQUEST["acaousuario"]) {

    case 'cadastrarUsuario':
        $user_Login = $_POST["user_Login"];
        $user_Senha = ($_POST["user_Senha"]);
        $user_Senha2 = ($_POST["user_Senha2"]);
        $user_Nome = $_POST["user_Nome"];
        $user_precpf = $_POST["user_CPF"]; //md5?
        $user_Email = $_POST["user_Email"];
        $user_Telefone = $_POST["user_Telefone"];
        $user_Autoridade = 1;

        cadastraval($user_Login, $user_Senha, $user_Senha2, $user_Nome, $user_precpf, $user_Email, $user_Telefone);
        confirmarsenha($user_Senha, $user_Senha2);
        $user_CPF = validaCPF($user_precpf);

        $user_Senha = md5($user_Senha);
        $user_Senha2 = md5($user_Senha2);

        $sql = "SELECT user_Login, user_CPF, user_Email FROM usuario";
        $res = $conn->query($sql);
        $qtd = $res->num_rows;
        $erro = false;
        if ($qtd > 0) {
            while ($row = $res->fetch_object()) {
                if (trim($user_Login) == $row->user_Login) {
                    print "<p class='alert alert-danger'>Usuário já existe!</p>";
                    $erro = true;
                } else if (intval($user_CPF) == $row->user_CPF) {
                    print "<p class='alert alert-danger'>CPF já está em uso!</p>";
                    $erro = true;
                } else if (trim($user_Email) == $row->user_Email) {
                    print "<p class='alert alert-danger'>E-mail já em uso!</p>";
                    $erro = true;
                }
                if ($erro == true) {
                    exit;
                }
            }
        }

        $sql = "INSERT INTO usuario (user_Login,user_Senha,user_Nome, user_CPF,user_Email,user_Telefone,user_Autoridade) 
            VALUES('{$user_Login}', 
                   '{$user_Senha}',
                   '{$user_Nome}', 
                   '{$user_CPF}', 
                   '{$user_Email}', 
                   '{$user_Telefone}',
                   '{$user_Autoridade}')";

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Usuário cadastrado com sucesso');</script>";
            print "<script>location.href='index.php';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar');</script>";
            print "<script>location.href='index.php';</script>";
        }
        break;


    case 'editarusuario':

        $user_Login = $_POST["user_Login"];
        $user_Senha = $_POST["user_Senha"];
        $user_Senha2 = $_POST["user_Senha2"];
        $user_Nome = $_POST["user_Nome"];
        $user_Email = $_POST["user_Email"];
        $user_Telefone = $_POST["user_Telefone"];
        $user_Autoridade = $_POST["user_Autoridade"];
        $user_SenhaAntiga = $_POST["user_SenhaAntiga"];

        editarval($user_Login, $user_SenhaAntiga, $user_Senha, $user_Senha2, $user_Nome, $user_Autoridade, $user_Email, $user_Telefone);
        confirmarsenha($user_Senha, $user_Senha2);

        $user_Senha = md5($user_Senha);
        $user_Senha2 = md5($user_Senha2);
        $user_SenhaAntiga = md5($user_SenhaAntiga);
        $cd_Usuario = $_REQUEST["cd_Usuario"];

        $sql = "SELECT cd_Usuario, user_Senha, user_Login, user_Email FROM usuario";
        $res = $conn->query($sql);
        $qtd = $res->num_rows;
        $erropass = true;
        $erro = false;

        if ($qtd > 0) {
            while ($row = $res->fetch_object()) {
                if ($cd_Usuario == $row->cd_Usuario && trim($user_SenhaAntiga) == $row->user_Senha) {
                    $erropass = false;
                } else if ($cd_Usuario != $row->cd_Usuario && trim($user_Login) == $row->user_Login) {
                    print "<p class='alert alert-danger'>Usuário já existe!</p>";
                    $erro = true;
                } else if ($cd_Usuario != $row->cd_Usuario && trim($user_Email) == $row->user_Email) {
                    print "<p class='alert alert-danger'>E-mail já em uso!</p>";
                    $erro = true;
                }
            }
        }
        if ($erro == true || $erropass == true) {
            exit;
        } else {

            $sql = "UPDATE usuario SET user_Login = '{$user_Login}',
                                    user_Senha = '{$user_Senha}',
                                    user_Nome = '{$user_Nome}', 
                                    user_Email = '{$user_Email}',
                                    user_Telefone = '{$user_Telefone}', 
                                    user_Autoridade = '{$user_Autoridade}'
                        WHERE
                            cd_Usuario=" . $_REQUEST["cd_Usuario"];

            $res = $conn->query($sql);
            if ($res == true) {
                print "<script>alert('Editado com sucesso');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            }
        }
        break;


    case 'excluirusuario':

        $sql = "SELECT user_Autoridade FROM usuario WHERE cd_Usuario =" . $_REQUEST["cd_Usuario"];
        $res = $conn->query($sql);
        $row = $res->fetch_object();
        $invalido = false;
        $delautoridade = $row->user_Autoridade;

        if ($delautoridade < 2) {
            print "<script>alert('Você não possue autoridade para excluir isso');</script>";
        } else {
            $sql = "DELETE FROM usuario WHERE cd_Usuario=" . $_REQUEST["cd_Usuario"];

            $res = $conn->query($sql);

            if ($res == true) {
                print "<script>alert('Excluido com sucesso');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            } else {
                print "<script>alert('Não foi possível excluir');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            }
        }
        break;

    case 'loginusuario':

        $user_Login = trim($_POST["user_Login"]);
        $user_Senha = trim($_POST["user_Senha"]);
        loginval($user_Login, $user_Senha);
        $user_Senha = md5($user_Senha);

        $sql = "SELECT user_Login, user_Nome, user_Senha, user_Autoridade FROM usuario";
        $res = $conn->query($sql);
        $qtd = $res->num_rows;
        $erro = true;
        if ($qtd > 0) {
            while ($row = $res->fetch_object()) {
                if ($user_Login == $row->user_Login && $user_Senha == $row->user_Senha) {
                    $autoridade = $row->user_Autoridade;
                    $nome = $row->user_Nome;
                    session_start();
                    $_SESSION["user"] = [$nome, $autoridade];
                    loginAutoridade($autoridade);
                    $erro = false;
                }
            }
        }
        if ($erro = true) {
            print "<script>alert('Usuário ou senha inválidos!');</script>";
            print "<script>location.href='index.php';</script>";
        }
        break;


    case 'gerenciarusuario':

        $user_Login = $_POST["user_Login"];
        $user_Nome = $_POST["user_Nome"];
        $user_Email = $_POST["user_Email"];
        $user_Telefone = $_POST["user_Telefone"];
        $user_Autoridade = $_POST["user_Autoridade"];

        gerenciarval($user_Login, $user_Nome, $user_Autoridade, $user_Email, $user_Telefone);

        $cd_Usuario = $_REQUEST["cd_Usuario"];

        $sql = "SELECT cd_Usuario, user_Login, user_Email FROM usuario";
        $res = $conn->query($sql);
        $qtd = $res->num_rows;
        $erro = false;

        if ($qtd > 0) {
            while ($row = $res->fetch_object()) {

                if ($cd_Usuario != $row->cd_Usuario && trim($user_Login) == $row->user_Login) {
                    print "<p class='alert alert-danger'>Usuário já existe!</p>";
                    $erro = true;
                } else if ($cd_Usuario != $row->cd_Usuario && trim($user_Email) == $row->user_Email) {
                    print "<p class='alert alert-danger'>E-mail já em uso!</p>";
                    $erro = true;
                }
            }
        }
        if ($erro == true) {
            exit;
        } else {

            $sql = "UPDATE usuario SET  user_Login = '{$user_Login}',
                                        user_Nome = '{$user_Nome}', 
                                        user_Email = '{$user_Email}',
                                        user_Telefone = '{$user_Telefone}', 
                                        user_Autoridade = '{$user_Autoridade}'
                            WHERE
                                cd_Usuario=" . $_REQUEST["cd_Usuario"];

            $res = $conn->query($sql);
            if ($res == true) {
                print "<script>alert('Editado com sucesso');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            }
        }
        break;

    case 'recuperarusuario':

        $user_Login = trim($_POST["user_Login"]);
        $user_Senha1 = $_POST["user_Senha1"];
        $user_Senha2 = $_POST["user_Senha2"];

        recuperarval($user_Login, $user_Senha1, $user_Senha2);
        confirmarsenha($user_Senha1, $user_Senha2);

        $user_Senha = md5($user_Senha1);

        $sql = "SELECT user_Login FROM usuario";
        $res = $conn->query($sql);
        $qtd = $res->num_rows;
        $find = false;

        if ($qtd > 0) {
            while ($row = $res->fetch_object()) {
                if ($user_Login == $row->user_Login)
                    $find = true;
            }
        }

        if ($find == true) {
            $sql = "UPDATE usuario SET user_Senha = '{$user_Senha}'
                                WHERE
                                user_Login= '{$user_Login}'";

            $res = $conn->query($sql);
            if ($res == true) {
                print "<script>alert('Senha alterada com sucesso');</script>";
                print "<script>location.href='index.php';</script>";
            } else {
                print "<script>alert('Usuário não encontrado');</script>";
                print "<script>location.href='index.php';</script>";
            }
        } else {
            print "<script>alert('Usuário não encontrado');</script>";
            print "<script>location.href='index.php';</script>";
        }
        break;
}
