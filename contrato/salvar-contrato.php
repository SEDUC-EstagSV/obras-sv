<?php
require_once 'function-contrato.php';

switch ($_REQUEST["acaocontrato"]) {
    case 'CadastrarContrato':
        $cd_Fornecedor = $_POST["cd_Fornecedor"];
        $dt_AnoContrato = $_POST["dt_AnoContrato"];
        $dt_Inicial = $_POST["dt_Inicial"];
        $dt_Final = $_POST["dt_Final"];
        $pr_Total = dataTotal($dt_Inicial, $dt_Final);
        $tp_Servico = $_POST["tp_Servico"];
        $st_Contrato = $_POST["st_Contrato"];

        $sql = "INSERT INTO contrato (cd_Fornecedor, dt_AnoContrato, dt_Inicial, dt_Final, pr_Total, tp_Servico, st_Contrato) 
            VALUES('{$cd_Fornecedor}', 
                   '{$dt_AnoContrato}',
                   '{$dt_Inicial}',
                   '{$dt_Final}',
                   '{$pr_Total}',
                   '{$tp_Servico}', 
                   '{$st_Contrato}')";

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Contrato cadastrado com sucesso');</script>";
            print "<script>location.href='?page=listar_contratos';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar');</script>";
            print "<script>location.href='?page=listar_contratos';</script>";
        }

        break;

    case 'editarcontrato':
        $cd_Fornecedor = $_POST["cd_Fornecedor"];
        $dt_AnoContrato = $_POST["dt_AnoContrato"];
        $dt_Inicial = $_POST["dt_Inicial"];
        $dt_Final = $_POST["dt_Final"];
        $pr_Total = dataTotal($dt_Inicial, $dt_Final);
        $tp_Servico = $_POST["tp_Servico"];
        $st_Contrato = $_POST["st_Contrato"];

        $sql = "UPDATE contrato SET cd_Fornecedor = '{$cd_Fornecedor}',
                                    dt_AnoContrato = '{$dt_AnoContrato}',
                                    dt_Inicial = '{$dt_Inicial}',
                                    dt_Final = '{$dt_Final}',
                                    pr_Total = '{$pr_Total}',
                                    tp_Servico = '{$tp_Servico}',
                                    st_Contrato = '{$st_Contrato}'
                        WHERE
                            cd_Contrato=" . $_REQUEST["cd_Contrato"];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Editado com sucesso');</script>";
            print "<script>location.href='?page=listar_contratos';</script>";
        } else {
            print "<script>alert('Não foi possível editar');</script>";
            print "<script>location.href='?page=listar_contratos';</script>";
        }
        break;

    case 'excluircontrato':
        $sql = "DELETE FROM contrato WHERE cd_Contrato=" . $_REQUEST["cd_Contrato"];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Excluido com sucesso');</script>";
            print "<script>location.href='?page=listar_contratos';</script>";
        } else {
            print "<script>alert('Não foi possível excluir');</script>";
            print "<script>location.href='?page=listar_contratos';</script>";
        }
        break;
}
