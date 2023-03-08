<?php


include_once('function-seduc.php');
include_once('function-fornecedor.php');
require('validator.php');
redirecionamentoPorAutoridade(3);


switch ($_REQUEST["acaofornecedor"]) {
    case 'CadastrarFornecedor':
        $nm_Fornecedor = validateInput($_POST["nm_Fornecedor"]);
        $num_CNPJ = validateInput($_POST["num_CNPJ"]);
        if(validar_cnpj($num_CNPJ) === false){
            print "<script>alert('O CNPJ informado é inválido');
                        window.history.go(-1);</script>";
            exit();
        }
        $ds_Email = validateInput($_POST["ds_Email"]);
        $ds_Endereco = validateInput($_POST["ds_Endereco"]);

        //verifica existencia de usuário
        try{
            $sqlVerifica = $conn->prepare("SELECT nm_Fornecedor, num_CNPJ, ds_Email FROM fornecedor WHERE ds_Email = ? OR num_CNPJ = ?");
            $sqlVerifica->bind_param('ss', $ds_Email, $num_CNPJ);
            $sqlVerifica->execute();
            $resVerifica = $sqlVerifica->get_result();
            
            $rowVerifica = $resVerifica->fetch_object();
            if($rowVerifica->ds_Email == $ds_Email || $rowVerifica->num_CNPJ == $num_CNPJ){
                print "<script>alert('O fornecedor $rowVerifica->nm_Fornecedor já foi cadastrado');
                        window.history.go(-1);</script>";
                exit();
            }
        } catch (mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao registrar fornecedor');
            window.history.go(-1);</script>";
            criaLogErro($e);
            exit();
        }

        try{
            $sql = $conn->prepare("INSERT INTO fornecedor (nm_Fornecedor, num_CNPJ, ds_Email, ds_Endereco) 
                VALUES(?,?,?,?)");
            $sql->bind_param('ssss', $nm_Fornecedor, $num_CNPJ, $ds_Email, $ds_Endereco);
    
            $res = $sql->execute();
    
            if ($res == true) {
                print "<script>alert('Fornecedor cadastrado com sucesso');</script>";
                print "<script>location.href='?page=listar_fornecedores';</script>";
            } else {
                print "<script>alert('Não foi possível cadastrar');</script>";
                print "<script>location.href='?page=listar_fornecedores';</script>";
            }
        } catch (mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao registrar fornecedor');
                    window.history.go(-1);</script>";
            criaLogErro($e);
            exit();
        }

        break;

    case 'editarfornecedor':
        $cd_Fornecedor = validateInput($_REQUEST["cd_Fornecedor"]);
        $nm_Fornecedor = validateInput($_POST["nm_Fornecedor"]);
        $num_CNPJ = validateInput($_POST["num_CNPJ"]);
        $ds_Email = validateInput($_POST["ds_Email"]);
        $ds_Endereco = validateInput($_POST["ds_Endereco"]);

        try{
            $sql = $conn->prepare("UPDATE fornecedor SET nm_Fornecedor = ?,
                                                        num_CNPJ = ?,
                                                        ds_Email = ?,
                                                        ds_Endereco = ? 
                                    WHERE
                                        cd_Fornecedor = ?");
    
            $sql->bind_param('sssss',$nm_Fornecedor, $num_CNPJ, $ds_Email, $ds_Endereco, $cd_Fornecedor);

            $res = $sql->execute();
    
            if ($res == true) {
                print "<script>alert('Editado com sucesso');</script>";
                print "<script>location.href='?page=listar_fornecedores';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listar_fornecedores';</script>";
            }
        } catch (mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao editar fornecedor');
                    window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;

    case 'excluirFornecedor':
        $cd_Fornecedor = $_REQUEST["cd_Fornecedor"];

        try{
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
        } catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao tentar excluir fornecedor');</script>";
            criaLogErro($e);
        }
        break;
}
