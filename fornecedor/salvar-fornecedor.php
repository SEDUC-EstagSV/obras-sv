<?php


include_once('function-seduc.php');
require('validator.php');
require_once 'function-fornecedor.php';
redirecionamentoPorAutoridade(4);


switch ($_REQUEST["acaofornecedor"]) {
    case 'CadastrarFornecedor':
        $modal = validateInput($_POST['modal'] ? $_POST['modal'] : 0);
        $nm_Fornecedor = validateInput($_POST["nm_Fornecedor"]);
        $num_CNPJ = validateInput($_POST["num_CNPJ"]);
        $ds_Email = validateInput($_POST["ds_Email"]);
        $ds_Endereco = validateInput($_POST["ds_Endereco"]);

        try {
            $sql = $conn->prepare("INSERT INTO fornecedor (nm_Fornecedor, num_CNPJ, ds_Email, ds_Endereco) 
                VALUES(?,?,?,?)");
            $sql->bind_param('ssss', $nm_Fornecedor, $num_CNPJ, $ds_Email, $ds_Endereco);

            $res = $sql->execute();

            if ($res == true) {
                print "<script>alert('Fornecedor cadastrado com sucesso');</script>";


                print "<script>window.close();</script>";
                if ($modal == 0) {
                    print "<script>location.href='?page=listar_fornecedores';</script>";
                } else {
                    print "<script>window.history.go(-1);</script>";
                }
            } else {
                print "<script>alert('Não foi possível cadastrar');</script>";
                if ($modal == 0) {
                    print "<script>location.href='?page=listar_fornecedores';</script>";
                } else {
                    print "<script>window.history.go(-1);</script>";
                }
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao registrar fornecedor');
                    window.history.go(-1);</script>";
            criaLogErro($e);
            exit();
        }

        break;

    case 'editarfornecedor':
        $cd_Fornecedor = validateInput($_REQUEST["cd_Fornecedor"]);
        $nm_Fornecedor = validateInput($_POST["nm_Fornecedor"]);
        $num_CNPJ = validar_cnpj($_POST["num_CNPJ"]);
        $ds_Email = validateInput($_POST["ds_Email"]);
        $ds_Endereco = validateInput($_POST["ds_Endereco"]);

        try {
            $sql = $conn->prepare("UPDATE fornecedor SET nm_Fornecedor = ?,
                                                        num_CNPJ = ?,
                                                        ds_Email = ?,
                                                        ds_Endereco = ?
                                    WHERE
                                        cd_Fornecedor = ?");

            $sql->bind_param('ssssi', $nm_Fornecedor, $num_CNPJ, $ds_Email, $ds_Endereco, $cd_Fornecedor);

            $res = $sql->execute();

            if ($res == true) {
                print "<script>alert('Editado com sucesso');</script>";
                print "<script>location.href='?page=listar_fornecedores';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listar_fornecedores';</script>";
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao editar fornecedor');
                    window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;

    case 'excluirFornecedor':
        $cd_Fornecedor = $_REQUEST["cd_Fornecedor"];

        try {
            $sql = $conn->prepare("DELETE FROM fornecedor WHERE cd_Fornecedor = ?");
            $sql->bind_param('i', $cd_Fornecedor);

            $res = $sql->execute();

            if ($res == true) {
                print "<script>alert('Excluido com sucesso');</script>";
                print "<script>location.href='?page=listar_fornecedores';</script>";
            } else {
                print "<script>alert('Não foi possível excluir');</script>";
                print "<script>location.href='?page=listar_fornecedores';</script>";
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao tentar excluir fornecedor');</script>";
            criaLogErro($e);
        }
        break;
}
