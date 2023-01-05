<?php
include_once('function-seduc.php');

confereAutoridade();

switch ($_REQUEST["acaoescola"]) {

    case 'cadastrarEscola':
        $nm_Escola = $_POST["nm_Escola"];
        $ds_Local = $_POST["ds_Local"];
        $st_Escola = $_POST["st_Escola"];


        $sql = "INSERT INTO escola (nm_Escola, ds_Local,st_Escola) 
            VALUES('{$nm_Escola}', '{$ds_Local}', '{$st_Escola}')";

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Cadastro com sucesso');</script>";
            print "<script>location.href='?page=listar_Escolas';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar');</script>";
            print "<script>location.href='?page=listar_Escolas';</script>";
        }

        break;

    case 'editarescola':
        $nm_Escola = $_POST["nm_Escola"];
        $ds_Local = $_POST["ds_Local"];
        $st_Escola = $_POST["st_Escola"];

        $sql = "UPDATE escola SET   nm_Escola = '{$nm_Escola}',
                                        ds_Local = '{$ds_Local}',
                                        st_Escola = '{$st_Escola}'
                                WHERE
                                    cd_Escola=" . $_REQUEST["cd_Escola"];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Escola editada com sucesso');</script>";
            print "<script>location.href='?page=listar_Escolas';</script>";
        } else {
            print "<script>alert('Não foi possível editar a escola');</script>";
            print "<script>location.href='?page=listar_Escolas';</script>";
        }
        break;


    case 'excluirEscola':
        $sql = "DELETE FROM escola WHERE cd_Escola=" . $_REQUEST["cd_Escola"];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Excluido com sucesso');</script>";
            print "<script>location.href='?page=listar_Escolas';</script>";
        } else {
            print "<script>alert('Não foi possível excluir');</script>";
            print "<script>location.href='?page=listar_Escolas';</script>";
        }
        break;
}
