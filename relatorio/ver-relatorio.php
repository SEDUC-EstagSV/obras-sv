<?php
include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);
?>

<h1>Ver relatório</h1>


<form action="?page=ver-relatorio2.php" method="POST" enctype="multipart/form-data">
       <div class="mb-3">
        <label>Relatórios</label>

        <?php
        try {
            $sql = "SELECT * FROM fornecedor";

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

            print "<option value={$row->cd_Fornecedor}>" . $row->nm_Fornecedor . "</option>";

        }
        print "</datalist>";
        print "</select>";
        ?>

    </div>

    
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>