<?php


include_once('function-seduc.php');
require('validator.php');
redirecionamentoPorAutoridade(4);


switch ($_REQUEST["acaoobra"]) {
    case 'cadastrarObra':
        $st_Obra = validateInput($_POST["st_Obra"]);
        $cd_Escola = validateInput($_POST["nm_Escola"]);
        //$nm_Contratante = $_POST["nm_Contratante"];
        $tp_AtivDescricao = validateInput($_POST["tp_AtivDescricao"]);
        $valueContrato = explode('/', $_POST["num_contrato"]);
        $numContrato = validateInput($valueContrato[0]);
        $anoContrato = validateInput($valueContrato[1]);
        if (isset($_POST["usuarios"])) {
            $usuarios = validateArray($_POST["usuarios"]);
        } else {
            $usuarios = null;
        }

        try {
            $sql = $conn->prepare("INSERT INTO obra (cd_Escola,tp_AtividadeDescricao,cd_situacaoObra, cd_Contrato) 
                    VALUES(?,?,?,(SELECT cd_Contrato FROM contrato WHERE num_contrato = ? AND dt_AnoContrato = ?))");
            $sql->bind_param(
                'isiss',
                $cd_Escola,
                $tp_AtivDescricao,
                $st_Obra,
                $numContrato,
                $anoContrato
            );

            $res = $sql->execute();
            if ($res == true) {

                if ($usuarios != null) {

                    $cd_Obra = $conn->insert_id;

                    try {
                        $sql = $conn->prepare("INSERT INTO obra_has_usuario (cd_Obra, cd_Usuario) VALUES (?,?)");
                        foreach ($usuarios as $cd_Usuario) {
                            $sql->bind_param('ii', $cd_Obra, $cd_Usuario);
                            $sql->execute();
                        }
                    } catch (mysqli_sql_exception $e) {
                        try {
                            $sql = "DELETE FROM obra ORDER BY cd_Obra DESC LIMIT 1";
                            $conn->query($sql);
                        } catch (mysqli_sql_exception $e) {
                            criaLogErro($e);
                        }

                        print "<script>alert('Não foi possível cadastrar obra');</script>";
                        print "<script>location.href='?page=listaobra';</script>";
                        criaLogErro($e);
                    }
                }

                print "<script>alert('Cadastro com sucesso');</script>";
                print "<script>location.href='?page=listaobra';</script>";
            } else {
                print "<script>alert('Não foi possível cadastrar');</script>";
                print "<script>location.href='?page=listaobra';</script>";
                criaLogErro($e);
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Não foi possível cadastrar. Verifique se os dados estão corretos');</script>";
            print "<script>window.history.go(-1);</script>";
            criaLogErro($e);
        }


        break;

    case 'editarobra':
        $cd_Obra = validateInput($_REQUEST["cd_Obra"]);
        //$cd_Escola = $_POST["cd_Escola"];
        //$cd_Contrato = $_POST["cd_Contrato"];
        $nm_Contratante = validateInput($_POST["nm_Contratante"]);
        $tp_AtivDescricao = validateInput($_POST["tp_AtivDescricao"]);
        $st_Obra = validateInput($_POST["st_Obra"]);
        //$tp_Comentario = $_POST["tp_Comentario"];
        if (isset($_POST["usuarios"])) {
            $usuarios = validateArray($_POST["usuarios"]);
        } else {
            $usuarios = null;
        }

        try {
            $sql = $conn->prepare("UPDATE obra SET 
                                        nm_Contratante = ?, 
                                        tp_AtividadeDescricao = ?,
                                        cd_situacaoObra = ? 
                            WHERE
                                cd_Obra= ?");

            $sql->bind_param('ssii', $nm_Contratante, $tp_AtivDescricao, $st_Obra, $cd_Obra);
            $res = $sql->execute();

            if ($res == true) {

                try {
                    $sql = $conn->prepare("DELETE FROM obra_has_usuario WHERE cd_Obra = ?");
                    $sql->bind_param('i', $cd_Obra);
                    $resDelete = $sql->execute();

                    if ($resDelete == true) {

                        if ($usuarios != null) {
                            try {
                                $sqlInsert = $conn->prepare("INSERT INTO obra_has_usuario (cd_Obra, cd_Usuario) VALUES (?,?)");
                                foreach ($usuarios as $cd_Usuario) {
                                    $sqlInsert->bind_param('ii', $cd_Obra, $cd_Usuario);
                                    $sqlInsert->execute();
                                }
                            } catch (mysqli_sql_exception $e) {
                                print "<script>alert('Ocorreu um erro interno ao editar obra');
                                window.history.go(-1);</script>";
                                criaLogErro($e);
                            }
                        }
                    }
                } catch (mysqli_sql_exception $e) {
                    print "<script>alert('Ocorreu um erro interno ao editar obra');
                    window.history.go(-1);</script>";
                    criaLogErro($e);
                }


                print "<script>alert('Editado com sucesso');</script>";
                print "<script>location.href='?page=listaobra';</script>";
            } else {
                print "<script>alert('Não foi possível editar');</script>";
                print "<script>location.href='?page=listaobra';</script>";
                criaLogErro($e);
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Não possível editar. Verifique se os dados estão corretos');</script>";
            print "<script>window.history.go(-1);</script>";
            criaLogErro($e);
        }
        break;

    case 'excluirObra':
        $cd_Obra = $_REQUEST["cd_Obra"];

        try {
            $desativado = 2;
            $sql = $conn->prepare("UPDATE obra SET cd_status_dados = ? WHERE cd_Obra= ?");
            $sql->bind_param('ii', $desativadp, $cd_Obra);

            $res = $sql->execute();

            if ($res == true) {
                print "<script>alert('Excluido com sucesso');</script>";
                print "<script>location.href='?page=listaobra';</script>";
            } else {
                print "<script>alert('Não foi possível excluir');</script>";
                print "<script>window.history.go(-1);</script>;</script>";
            }
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro ao tentar excluir');</script>";
            print "<script>window.history.go(-1);</script>;</script>";
            criaLogErro($e);
        }
        break;
}
