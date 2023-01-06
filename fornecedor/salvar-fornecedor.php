<?php


include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);


switch ($_REQUEST["acaofornecedor"]) {
    case 'CadastrarFornecedor':
        $nm_Fornecedor = $_POST["nm_Fornecedor"];
        $num_CNPJ = $_POST["num_CNPJ"];
        $ds_Email = $_POST["ds_Email"];
        $ds_Endereco = $_POST["ds_Endereco"];
        $st_Fornecedor = $_POST["st_Fornecedor"];

        $sql = "INSERT INTO fornecedor (nm_Fornecedor,num_CNPJ,ds_Email, ds_Endereco,st_Fornecedor) 
            VALUES('{$nm_Fornecedor}', 
                   '{$num_CNPJ}',
                   '{$ds_Email}', 
                   '{$ds_Endereco}', 
                   '{$st_Fornecedor}')";

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Fornecedor cadastrado com sucesso');</script>";
            print "<script>location.href='?page=listar_fornecedores';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar');</script>";
            print "<script>location.href='?page=listar_fornecedores';</script>";
        }

        break;

    case 'editarfornecedor':
        $nm_Fornecedor = $_POST["nm_Fornecedor"];
        $num_CNPJ = $_POST["num_CNPJ"];
        $ds_Email = $_POST["ds_Email"];
        $ds_Endereco = $_POST["ds_Endereco"];
        $st_Fornecedor = $_POST["st_Fornecedor"];

        $sql = "UPDATE fornecedor SET nm_Fornecedor = '{$nm_Fornecedor}',
                                    num_CNPJ = '{$num_CNPJ}',
                                    ds_Email = '{$ds_Email}',
                                    ds_Endereco = '{$ds_Endereco}', 
                                    st_Fornecedor = '{$st_Fornecedor}'
                        WHERE
                            cd_Fornecedor=" . $_REQUEST["cd_Fornecedor"];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Editado com sucesso');</script>";
            print "<script>location.href='?page=listar_fornecedores';</script>";
        } else {
            print "<script>alert('Não foi possível editar');</script>";
            print "<script>location.href='?page=listar_fornecedores';</script>";
        }
        break;

    case 'excluirFornecedor':
        $sql = "DELETE FROM fornecedor WHERE cd_Fornecedor=" . $_REQUEST["cd_Fornecedor"];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Excluido com sucesso');</script>";
            print "<script>location.href='?page=listar_fornecedores';</script>";
        } else {
            print "<script>alert('Não foi possível excluir');</script>";
            print "<script>location.href='?page=listar_fornecedores';</script>";
        }
        break;
}
