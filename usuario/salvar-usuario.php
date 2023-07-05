<?php
require_once('function-usuario.php');
require('validator.php');

switch ($_REQUEST["acaousuario"]) {

    case 'cadastrarUsuario':
        $modal = validateInput($_POST['modal'] ? $_POST['modal'] : 0);
        $user_Login = validateInput($_POST["user_Login"]);
        $user_Senha = validateInput($_POST["user_Senha"]);
        $user_Senha2 = validateInput($_POST["user_Senha2"]);
        $user_Nome = validateInput($_POST["user_Nome"]);
        $user_precpf = validateInput($_POST["user_CPF"]);
        $user_Email = validateInput($_POST["user_Email"]);
        $user_Telefone = validateInput($_POST["user_Telefone"]);
        $user_Autoridade = 1;
        if (isset($_POST["cd_Fornecedor"])) {
            $cd_fornecedor = validateInput($_POST["cd_Fornecedor"]);
        } else {
            $cd_fornecedor = null;
        }

        cadastraval($user_Login, $user_Senha, $user_Senha2, $user_Nome, $user_precpf, $user_Email, $user_Telefone);
        confirmarsenha($user_Senha, $user_Senha2);
        $user_CPF = validaCPF($user_precpf);

        $user_Senha = encryptSenha($user_Senha);

        try {
            $sql = "SELECT user_Login, user_CPF, user_Email FROM usuario";
            $res = $conn->query($sql);
            $qtd = $res->num_rows;
            $erro = false;
            if ($qtd > 0) {
                while ($row = $res->fetch_object()) {
                    if (trim($user_Login) == $row->user_Login) {
                        print "<script>alert('Usuário já existe!')</script>";
                        $erro = true;
                    } else if (intval($user_CPF) == $row->user_CPF) {
                        print "<p class='alert alert-danger'>CPF já está em uso!</p>";
                        $erro = true;
                    } else if (trim($user_Email) == $row->user_Email) {
                        print "<p class='alert alert-danger'>E-mail já em uso!</p>";
                        $erro = true;
                    }
                    if ($erro == true) {
                        print "<script>window.history.go(-1);</script>";
                        exit;
                    }
                }
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao verificar existência do usuário');
                    window.history.go(-1);</script>";
            criaLogErro($e);
            exit();
        }

        try {
            $sql = $conn->prepare("INSERT INTO usuario (user_Login,user_Senha,user_Nome, user_CPF,user_Email,user_Telefone,cd_nivelAutoridade, cd_Fornecedor) 
                VALUES(?,?,?,?,?,?,?,?)");

            $sql->bind_param('ssssssii', $user_Login, $user_Senha, $user_Nome, $user_CPF, $user_Email, $user_Telefone, $user_Autoridade, $cd_fornecedor);

            $res = $sql->execute();

            if ($res == true) {
                print "<script>alert('Usuário cadastrado com sucesso');</script>";

                if ($modal == 0) {
                    print "<script>location.href='painel.php';</script>";
                } else {
                    print "<script>window.history.go(-1);</script>";
                }
            } else {
                print "<script>alert('Não foi possível cadastrar');</script>";
                if ($modal == 0) {
                    print "<script>location.href='painel.php';</script>";
                } else {
                    print "<script>window.history.go(-1);</script>";
                }
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao criar usuário');
                                    window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;


    case 'editarusuario':

        $user_Login = validateInput($_POST["user_Login"]);
        $user_Senha = validateInput($_POST["user_Senha"]);
        $user_Senha2 = validateInput($_POST["user_Senha2"]);
        $user_Nome = validateInput($_POST["user_Nome"]);
        $user_Email = validateInput($_POST["user_Email"]);
        $user_Telefone = validateInput($_POST["user_Telefone"]);
        $cd_Autoridade = validateInput($_POST["cd_Autoridade"]);
        $user_SenhaAntiga = validateInput($_POST["user_SenhaAntiga"]);

        editarval($user_Login, $user_SenhaAntiga, $user_Senha, $user_Senha2, $user_Nome, $cd_Autoridade, $user_Email, $user_Telefone);
        confirmarsenha($user_Senha, $user_Senha2);

        $user_Senha = encryptSenha($user_Senha);
        $user_SenhaAntiga = encryptSenha($user_SenhaAntiga);
        $cd_Usuario = validateInput($_REQUEST["cd_Usuario"]);

        try {
            $sql = "SELECT cd_Usuario, user_Senha, user_Login, user_Email FROM usuario";
            $res = $conn->query($sql);
            $qtd = $res->num_rows;
            $erropass = true;
            $erro = false;

            if ($qtd > 0) {
                while ($row = $res->fetch_object()) {
                    if ($cd_Usuario == $row->cd_Usuario && password_verify($user_SenhaAntiga, $row->user_Senha)) {
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
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao verificar dados de usuário');
                                    window.history.go(-1);</script>";
            criaLogErro($e);
            exit();
        }

        if ($erro == true || $erropass == true) {
            exit();
        }

        try {
            $sql = $conn->prepare("UPDATE usuario SET user_Login = ?,
                                    user_Senha = ?,
                                    user_Nome = ?, 
                                    user_Email = ?,
                                    user_Telefone = ?, 
                                    cd_nivelAutoridade = ?
                        WHERE
                            cd_Usuario = ?");

            $sql->bind_param('sssssii', $user_Login, $user_Senha, $user_Nome, $user_Email, $user_Telefone, $cd_Autoridade, $cd_Usuario);

            $res = $sql->execute();
            if ($res == true) {
                print "<script>alert('Editado com sucesso');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao editar usuário');
                            window.history.go(-1);</script>";
            criaLogErro($e);
        }

        break;


    case 'excluirusuario':
        $cd_Usuario = validateInput($_REQUEST["cd_Usuario"]);

        $autoridade = $_SESSION['user'][1];

        if ($autoridade < 2) {
            print "<script>alert('Você não possui autoridade para excluir isso');</script>";
        }

        try {
            $sql = $conn->prepare("DELETE FROM usuario WHERE cd_Usuario=?");
            $sql->bind_param('i', $cd_Usuario);

            $res = $sql->execute();

            if ($res == true) {
                print "<script>alert('Excluido com sucesso');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            } else {
                print "<script>alert('Não foi possível excluir');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao excluir usuário');
                                location.reload();</script>";
            criaLogErro($e);
        }
        break;

    case 'loginusuario':

        $user_Login = validateInput($_POST["user_Login"]);
        $user_Senha = validateInput($_POST["user_Senha"]);
        loginval($user_Login, $user_Senha);

        try {
            $sql = "SELECT cd_Usuario, user_Login, user_Nome, user_Senha, cd_nivelAutoridade FROM usuario";
            $res = $conn->query($sql);
            $qtd = $res->num_rows;
            $erro = true;
            if ($qtd > 0) {
                while ($row = $res->fetch_object()) {
                    if ($user_Login == $row->user_Login && password_verify($user_Senha, $row->user_Senha)) {
                        $autoridade = $row->cd_nivelAutoridade;
                        $nome = $row->user_Nome;
                        $id = $row->cd_Usuario;
                        session_start();
                        $_SESSION["user"] = [$nome, $autoridade, $id];
                        $erro = false;
                        loginAutoridade($autoridade);
                    }
                }
            }
            if ($erro = true) {
                print "<script>alert('Usuário ou senha inválidos!');</script>";
                print "<script>location.href='painel.php';</script>";
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao tentar logar usuário');
                            window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;


    case 'gerenciarusuario':

        $user_Login = validateInput($_POST["user_Login"]);
        $user_Nome = validateInput($_POST["user_Nome"]);
        $user_Email = validateInput($_POST["user_Email"]);
        $user_Telefone = validateInput($_POST["user_Telefone"]);
        $user_Autoridade = validateInput($_POST["user_Autoridade"]);
        $cd_fornecedor = validateInput($_POST["cd_Fornecedor"]);

        gerenciarval($user_Login, $user_Nome, $user_Autoridade, $user_Email, $user_Telefone);

        $cd_Usuario = validateInput($_REQUEST["cd_Usuario"]);

        try {
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
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao verificar dados de usuário');
                            window.history.go(-1);</script>";
            criaLogErro($e);
            exit();
        }

        if ($erro == true) {
            exit();
        }

        try {
            $cd_Usuario = validateInput($_REQUEST["cd_Usuario"]);

            $sql = $conn->prepare("UPDATE usuario SET  
                                        user_Login = ?,
                                        user_Nome = ?, 
                                        user_Email = ?,
                                        user_Telefone = ?, 
                                        cd_nivelAutoridade = ?,
                                        cd_Fornecedor = ?
                            WHERE
                                cd_Usuario = ?");
            $sql->bind_param('ssssiii', $user_Login, $user_Nome, $user_Email, $user_Telefone, $user_Autoridade, $cd_fornecedor, $cd_Usuario);

            $res = $sql->execute();
            if ($res == true) {
                print "<script>alert('Editado com sucesso');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listar_usuario';</script>";
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao editar dados de usuário');
                                    window.history.go(-1);</script>";
            criaLogErro($e);
        }

        break;
}
