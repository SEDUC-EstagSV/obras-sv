<?php


include_once('function-seduc.php');


redirecionamentoPorAutoridade(4);


require_once('validator.php');
require_once 'function-contrato.php';

switch ($_REQUEST["acaocontrato"]) {
    case 'CadastrarContrato':
        $st_Contrato = validateInput($_POST["st_Contrato"]);
        $cd_Fornecedor = validateInput($_POST["cd_Fornecedor"]);
        $dt_AnoContrato = validateInput($_POST["dt_AnoContrato"]);
        $tp_Servico = validateInput($_POST["tp_Servico"]);
        $dt_Inicial = validateInput($_POST["dt_Inicial"]);
        $dt_Final = validateInput($_POST["dt_Final"]);
        $num_contrato = validateInput($_POST["num_contrato"]);
        if (isset($_POST["escolas"])) {
            $escolas = validateArray($_POST["escolas"]);
        } else {
            $escolas = null;
        }
        $pr_Total = dataTotal($dt_Inicial, $dt_Final);

        try {
            $sql = $conn->prepare("INSERT INTO contrato (cd_Fornecedor, dt_AnoContrato, dt_Inicial, dt_Final, pr_Total, tp_Servico, cd_situacao, num_contrato) 
                VALUES(?,?,?,?,?,?,?,?)");
            $sql->bind_param('iissssss', $cd_Fornecedor, $dt_AnoContrato, $dt_Inicial, $dt_Final, $pr_Total, $tp_Servico, $st_Contrato, $num_contrato);

            $res = $sql->execute();
            if ($res == true) {

                if ($escolas != null) {
                    $cd_Contrato = $conn->insert_id;
                    try {
                        $sql = $conn->prepare("INSERT INTO escola_has_contrato (cd_Escola, cd_Contrato) VALUES (?,?)");
                        foreach ($escolas as $cd_escola) {
                            $sql->bind_param('ii', $cd_escola, $cd_Contrato);
                            $sql->execute();
                        }
                    } catch (mysqli_sql_exception $e) {
                        try {
                            $sql = "DELETE FROM contrato ORDER BY cd_Contrato DESC LIMIT 1";
                            $conn->query($sql);
                        } catch (mysqli_sql_exception $e) {
                            criaLogErro($e);
                        }

                        print "<script>alert('Não foi possível cadastrar contrato');</script>";
                        print "<script>location.href='?page=listar_contratos';</script>";
                        criaLogErro($e);
                    }
                }

                print "<script>alert('Contrato cadastrado com sucesso');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
            } else {
                print "<script>alert('Não foi possível cadastrar contrato');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
                criaLogErro($e);
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao criar contrato');
            window.history.go(-1);</script>";
            criaLogErro($e);
        }

        break;

    case 'editarcontrato':
        $cd_Contrato = validateInput($_REQUEST["cd_Contrato"]);
        $cd_Fornecedor = validateInput($_POST["cd_Fornecedor"]);
        $dt_AnoContrato = validateInput($_POST["dt_AnoContrato"]);
        $dt_Inicial = validateInput($_POST["dt_Inicial"]);
        $dt_Final = validateInput($_POST["dt_Final"]);
        $pr_Total = dataTotal($dt_Inicial, $dt_Final);
        $tp_Servico = validateInput($_POST["tp_Servico"]);
        $st_Contrato = validateInput($_POST["st_Contrato"]);
        if (isset($_POST["escolas"])) {
            $escolas = validateArray($_POST["escolas"]);
        } else {
            $escolas = null;
        }

        try {
            $sql = $conn->prepare("UPDATE contrato SET 
                                        cd_Fornecedor = ?,
                                        dt_AnoContrato = ?,
                                        dt_Inicial = ?,
                                        dt_Final = ?,
                                        pr_Total = ?,
                                        tp_Servico = ?,
                                        cd_situacao = ?
                            WHERE
                                cd_Contrato = ?");
            $sql->bind_param('iisssssi', $cd_Fornecedor, $dt_AnoContrato, $dt_Inicial, $dt_Final, $pr_Total, $tp_Servico, $st_Contrato, $cd_Contrato);

            $res = $sql->execute();

            if ($res == true) {
                try {
                    $sql = $conn->prepare("DELETE FROM escola_has_contrato WHERE cd_Contrato = ?");
                    $sql->bind_param('i', $cd_Contrato);
                    $resDelete = $sql->execute();

                    if ($resDelete == true) {
                        if ($escolas != null) {
                            try {
                                $sqlInsert = $conn->prepare("INSERT INTO escola_has_contrato (cd_Escola, cd_Contrato) VALUES (?,?)");
                                foreach ($escolas as $cd_escola) {
                                    $sqlInsert->bind_param('ii', $cd_escola, $cd_Contrato);
                                    $sqlInsert->execute();
                                }
                            } catch (mysqli_sql_exception $e) {
                                print "<script>alert('Ocorreu um erro interno ao editar contrato');
                                window.history.go(-1);</script>";
                                criaLogErro($e);
                            }
                        }
                    }
                } catch (mysqli_sql_exception $e) {
                    print "<script>alert('Ocorreu um erro interno ao editar contrato');
                    window.history.go(-1);</script>";
                    criaLogErro($e);
                }


                print "<script>alert('Editado com sucesso');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao editar contrato');
            window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;

    case 'excluircontrato':
        $cd_Contrato = $_REQUEST["cd_Contrato"];

        try {
            $sql = $conn->prepare("DELETE FROM contrato WHERE cd_Contrato = ?");
            $sql->bind_param('i', $cd_Contrato);

            $res = $sql->execute();

            if ($res == true) {
                try {
                    $sql = $conn->prepare("DELETE FROM escola_has_contrato WHERE cd_Contrato = ?");
                    $sql->bind_param('i', $cd_Contrato);

                    $res = $sql->execute();

                    if ($res == true) {
                        print "<script>alert('Excluido com sucesso');</script>";
                        print "<script>location.href='?page=listar_contratos';</script>";
                    } else {
                        print "<script>alert('Não foi possível excluir');</script>";
                        print "<script>location.href='?page=listar_contratos';</script>";
                    }
                } catch (mysqli_sql_exception $e) {
                    print "<script>alert('Ocorreu um erro interno ao excluir contrato');
                    window.history.go(-1);</script>";
                    criaLogErro($e);
                }
            } else {
                print "<script>alert('Não foi possível excluir');</script>";
                print "<script>location.href='?page=listar_contratos';</script>";
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao excluir contrato');
            window.history.go(-1);</script>";
            criaLogErro($e);
        }

        break;
}
