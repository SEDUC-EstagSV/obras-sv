<?php


include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);


switch ($_REQUEST["acaoobra"]) {
    case 'cadastrarObra':
        $cd_Escola = $_POST["cd_Escola"];
        $nm_Obra = $_POST["nm_Obra"];
        $cd_Contrato = $_POST["cd_Contrato"];
        $nm_Contratante = $_POST["nm_Contratante"];
        $tp_AtivDescricao = $_POST["tp_AtivDescricao"];
        $st_Obra = $_POST["st_Obra"];
        $tp_Comentario = $_POST["tp_Comentario"];

        $sql = "INSERT INTO obra (cd_Escola,nm_obra,cd_Contrato, nm_Contratante,tp_AtivDescricao,tp_Comentario,st_Obra) 
            VALUES('{$cd_Escola}', 
                   '{$nm_Obra}',
                   '{$cd_Contrato}', 
                   '{$nm_Contratante}', 
                   '{$tp_AtivDescricao}', 
                   '{$tp_Comentario}'
                   '{$st_Obra}')";

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Cadastro com sucesso');</script>";
            print "<script>location.href='?page=listaobra';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar');</script>";
            print "<script>location.href='?page=listaobra';</script>";
        }

        break;

    case 'editarobra':
        $cd_Escola = $_POST["cd_Escola"];
        $nm_Obra = $_POST["nm_Obra"];
        $cd_Contrato = $_POST["cd_Contrato"];
        $nm_Contratante = $_POST["nm_Contratante"];
        $tp_AtivDescricao = $_POST["tp_AtivDescricao"];
        $st_Obra = $_POST["st_Obra"];
        $tp_Comentario = $_POST["tp_Comentario"];

        $sql = "UPDATE obra SET cd_Escola = '{$cd_Escola}',
                                    nm_Obra = '{$nm_Obra}',
                                    cd_Contrato = '{$cd_Contrato}',
                                    nm_Contratante = '{$nm_Contratante}', 
                                    tp_AtivDescricao = '{$tp_AtivDescricao}',
                                    st_Obra = '{$st_Obra}', 
                                    tp_Comentario = '{$tp_Comentario}'
                        WHERE
                            cd_Obra=" . $_REQUEST["cd_Obra"];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Editado com sucesso');</script>";
            print "<script>location.href='?page=listaobra';</script>";
        } else {
            print "<script>alert('Não foi possível editar');</script>";
            print "<script>location.href='?page=listaobra';</script>";
        }
        break;

    case 'excluirObra':
        $sql = "DELETE FROM obra WHERE cd_Obra=" . $_REQUEST["cd_Obra"];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Excluido com sucesso');</script>";
            print "<script>location.href='?page=listaobra';</script>";
        } else {
            print "<script>alert('Não foi possível excluir');</script>";
            print "<script>location.href='?page=listaobra';</script>";
        }
        break;
}
