<?php
include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);
?>

<h1>Ver relatório</h1>





<form action="" method="POST">
    <div class="mb-3">
        <label>Relatórios</label>

        <?php


        include_once('function-seduc.php');

        redirecionamentoPorAutoridade(3);


        require_once 'function-contrato.php';



        $cd_Fornecedor = $_POST["cd_Fornecedor"];

        try {
            $sql = "SELECT * FROM contrato WHERE cd_Fornecedor = $cd_Fornecedor";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de fornecedores');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }

        print "<select class='form-select' name='cd_Fornecedor'>";
        print "<datalist>";
        print "<option value='' disabled selected>1º - Selecione o fornecedor</option>";


        while ($row = $res->fetch_object()) {

            print "<option value={$row->cd_Fornecedor}>" . $row->cd_Contrato . "</option>";
        }
        print "</datalist>";
        print "</select>";
        ?>
    </div>



    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>