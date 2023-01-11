<?php


include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);


require_once 'function-contrato.php';

switch ($_REQUEST["acaocontrato"]) {
    case 'CadastrarContrato':
        $cd_Fornecedor = $_POST["cd_Fornecedor"];
        $cd_Fornecedor = substr($cd_Fornecedor, 0, strpos($cd_Fornecedor, "-"));
        $dt_AnoContrato = $_POST["dt_AnoContrato"];
        $dt_Inicial = $_POST["dt_Inicial"];
        $dt_Final = $_POST["dt_Final"];
        $pr_Total = dataTotal($dt_Inicial, $dt_Final);
        $tp_Servico = $_POST["tp_Servico"];
        $st_Contrato = $_POST["st_Contrato"];

        try{
            $sql = $conn->prepare("INSERT INTO contrato (cd_Fornecedor, dt_AnoContrato, dt_Inicial, dt_Final, pr_Total, tp_Servico, st_Contrato) 
                VALUES(?,?,?,?,?,?,?)");
            $sql->bind_param('iisssss', $cd_Fornecedor, $dt_AnoContrato, $dt_Inicial, $dt_Final, $pr_Total, $tp_Servico, $st_Contrato);
            
            $res = $sql->execute();
    
            if ($res == true) {
                print "<script>alert('Contrato cadastrado com sucesso');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
            } else {
                print "<script>alert('Não foi possível cadastrar');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
            }

        } catch(mysqli_sql_exception){
            print "<script>alert('Ocorreu um erro interno ao buscar ao criar contrato');
            window.history.go(-1);</script>";
        }

        break;

    case 'editarcontrato':
        $cd_Contrato = $_REQUEST["cd_Contrato"];
        $cd_Fornecedor = $_POST["cd_Fornecedor"];
        $dt_AnoContrato = $_POST["dt_AnoContrato"];
        $dt_Inicial = $_POST["dt_Inicial"];
        $dt_Final = $_POST["dt_Final"];
        $pr_Total = dataTotal($dt_Inicial, $dt_Final);
        $tp_Servico = $_POST["tp_Servico"];
        $st_Contrato = $_POST["st_Contrato"];

        try{
            $sql = $conn->prepare("UPDATE contrato SET cd_Fornecedor = ?,
                                        dt_AnoContrato = ?,
                                        dt_Inicial = ?,
                                        dt_Final = ?,
                                        pr_Total = ?,
                                        tp_Servico = ?,
                                        st_Contrato = ?
                            WHERE
                                cd_Contrato = ?");
            $sql->bind_param('iisssssi', $cd_Fornecedor, $dt_AnoContrato, $dt_Inicial, $dt_Final, $pr_Total, $tp_Servico, $st_Contrato, $cd_Contrato);
            
            $res = $sql->execute();
    
            if ($res == true) {
                print "<script>alert('Editado com sucesso');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
            }

        } catch(mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao excluir contrato');
                            location.reload();</script>";
            criaLogErro($e);
        }
        break;

    case 'excluircontrato':
        $cd_Contrato = $_REQUEST["cd_Contrato"];

        try{
            $sql = $conn->prepare("DELETE FROM contrato WHERE cd_Contrato = ?");
            $sql->bind_param('i', $cd_Contrato);
    
            $res = $sql->execute();
    
            if ($res == true) {
                print "<script>alert('Excluido com sucesso');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
            } else {
                print "<script>alert('Não foi possível excluir');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
            }

        } catch (mysqli_sql_exception $e){
            print "<script>alert('Ocorreu um erro interno ao excluir contrato');
            location.reload();</script>";
            criaLogErro($e);
        }
        break;
}
