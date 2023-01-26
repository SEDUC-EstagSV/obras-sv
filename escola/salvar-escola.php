<?php
include_once('function-seduc.php');
require('validator.php');

redirecionamentoPorAutoridade(3);

switch ($_REQUEST["acaoescola"]) {

    case 'cadastrarEscola':
        $nm_Escola = validateInput($_POST["nm_Escola"]);
        $ds_Local = validateInput($_POST["ds_Local"]);
        $st_Escola = validateInput($_POST["st_Escola"]);

        try{
            $sql = $conn->prepare("INSERT INTO escola (nm_Escola, ds_Local, cd_statusEscola) 
                VALUES(?, ?, ?)");
            $sql->bind_param('ssi', $nm_Escola, $ds_Local, $st_Escola);
            
            $res = $sql->execute();
    
            if ($res == true) {
                print "<script>alert('Cadastro com sucesso');</script>";
                print "<script>location.href='?page=listar_Escolas';</script>";
            } else {
                print "<script>alert('Não foi possível cadastrar');</script>";
                print "<script>location.href='?page=listar_Escolas';</script>";
            }

        } catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao registrar escola');
            window.history.go(-1);</script>";
            criaLogErro($e);
        }

        break;

    case 'editarescola':
        $cd_Escola = validateInput($_REQUEST["cd_Escola"]);
        $nm_Escola = validateInput($_POST["nm_Escola"]);
        $ds_Local = validateInput($_POST["ds_Local"]);
        $st_Escola = validateInput($_POST["st_Escola"]);

        try{
            $sql = $conn->prepare("UPDATE escola SET   
                                            nm_Escola = ?,
                                            ds_Local = ?,
                                            cd_statusEscola = ?
                                    WHERE
                                        cd_Escola = ?");

            $sql->bind_param('ssii', $nm_Escola, $ds_Local, $st_Escola, $cd_Escola);
    
            $res = $sql->execute();
    
            if ($res == true) {
                print "<script>alert('Escola editada com sucesso');</script>";
                print "<script>location.href='?page=listar_escolas';</script>";
            } else {
                print "<script>alert('Não foi possível editar a escola');</script>";
                print "<script>location.href='?page=listar_escolas';</script>";
            }

        } catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao editar escola');
            window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;


    case 'excluirEscola':
        try{
            $cd_Escola = $_REQUEST["cd_Escola"];
            $sql = $conn->prepare("DELETE FROM escola WHERE cd_Escola = ?");
            $sql->bind_param('i', $cd_Escola);

            $res = $sql->execute();
    
            if ($res == true) {
                print "<script>alert('Excluido com sucesso');</script>";
                print "<script>location.href='?page=listar_Escolas';</script>";
            } else {
                print "<script>alert('Não foi possível excluir');</script>";
                print "<script>location.href='?page=listar_Escolas';</script>";
            }

        } catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao excluir escola');
            window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;
}
