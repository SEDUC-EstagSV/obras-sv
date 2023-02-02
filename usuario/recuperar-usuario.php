<?php
require('./function-seduc.php');
require('./validator.php');

function resetCookies(){
    if (isset($_COOKIE['email']) || isset($_COOKIE['num_pedido']) || isset($_COOKIE['userId']) || isset($_COOKIE['numToCompare'])) {
        unset($_COOKIE['email']);
        unset($_COOKIE['num_pedido']);
        unset($_COOKIE['userId']);
        unset($_COOKIE['numToCompare']);
        setcookie('email', '', time() - 3600, '/');
        setcookie('num_pedido', '', time() - 3600, '/');
        setcookie('userId', '', time() - 3600, '/');
        setcookie('numToCompare', '', time() - 3600, '/');
    }
}

switch ($_REQUEST["acaousuario"]) {
    case "pedidoRecuperacao":
        $email = validateInput($_POST["user_Email"]);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            geraEmail($email);
            $_COOKIE['email'] = $email;
            header("Location: index.php?page=validarcodigo");
            exit();
        } else {
            print "<p class='alert alert-danger'>E-mail inválido</p>";
            exit();
        }
        break;
    case "validarCodigo":
        $codigo = validateInput($_POST["num_pedido"]);
        $email = $_COOKIE['email'];
        $_COOKIE['num_pedido'] = $codigo;

        try{
            $sql = $conn->prepare("SELECT cd_Usuario FROM usuario 
                                    WHERE user_Email = ?");
            $sql->bind_param('s', $email);
            $sql->execute();
            $res = $sql->get_result();
            $row = $res->fetch_object();
            $userId = $row->cd_Usuario;

            if($userId == null) {
                print "<script>alert('Usuário não encontrado');
                window.history.go(-1);</script>";

                resetCookies();
                exit();
            }

            $_COOKIE['userId'] = $userId;
        }catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno. Se o erro persistir entre em contato com o suporte.');window.history.go(-1);</script>";
            criaLogErro($e);
            exit();
        }


        try{
            $sql = $conn->prepare("SELECT * FROM pedido_recuperacao 
                                    WHERE cd_Usuario = ?
                                    ORDER BY DESC
                                    LIMIT 1");
            $sql->bind_param('ii', $userId, $codigo);
            $sql->execute();

            $res = $sql->get_result();
            $row = $res->fetch_object();

            $verificaCodigo = password_verify($codigo, $row->num_pedido_recuperacao);
            $_COOKIE['numToCompare'] = $row->num_pedido_recuperacao;
            if($verificaCodigo){
                header("Location: index.php?page=recuperarSenha");
            } else {
                print "<script>alert('Código incorreto');</script>";
                //remove cookies
                resetCookies();
                header("Location: index.php?page=validarcodigo");
            }
        }catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno. Se o erro persistir entre em contato com o suporte.');window.history.go(-1);</script>";
            criaLogErro($e);
            exit();
        }

        break;
    case "recuperarSenha":
        $user_Senha1 = validateInput($_POST["user_Senha1"]);
        $user_Senha2 = validateInput($_POST["user_Senha2"]);

        recuperarval($user_Senha1, $user_Senha2);
        confirmarsenha($user_Senha1, $user_Senha2);

        $user_Senha = encryptSenha($user_Senha1);
        
        if(password_verify($_COOKIE['num_pedido'], $_COOKIE['numToCompare'])){
            try{
                $sql = $conn->prepare("SELECT COUNT(*) AS existe FROM usuario WHERE user_Email = ?");
                $sql->bind_param('s', $_COOKIE['email']);
                $sql->execute();
                $res = $sql->get_result();
                $row = $res->fetch_object();
                $find = $row->existe;
        
                if ($find == 1) {
                    try{
                        $sql = $conn->prepare("UPDATE usuario SET user_Senha = ?
                                            WHERE
                                            user_Email = ?");
                        $sql->bind_param('ss', $user_Senha, $_COOKIE['email']);
            
                        $res = $sql->execute();
                        if ($res == true) {
                            print "<script>alert('Senha alterada com sucesso');</script>";
                            print "<script>location.href='painel.php';</script>";
                            resetCookies();
                        } else {
                            print "<script>alert('Usuário não encontrado');</script>";
                            print "<script>location.href='painel.php';</script>";
                            resetCookies();
                        }
        
                    } catch (mysqli_sql_exception $e){
                        print "<script>alert('Ocorreu um erro interno ao atualizar dados do usuário');
                                        window.history.go(-1);</script>";
                        resetCookies();
                        criaLogErro($e);
                    }
                } else {
                    print "<script>alert('Usuário não encontrado');</script>";
                    print "<script>location.href='painel.php';</script>";
                    resetCookies();
                }
        
            } catch (mysqli_sql_exception $e){
                print "<script>alert('Ocorreu um erro interno ao verificar dados de usuário');
                                window.history.go(-1);</script>";
                resetCookies();
                criaLogErro($e);
            }
        } else {
            resetCookies();
            header("Location: index.php");
        }

        break;
}

?>