<?php
include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);
?>

<h1>Novo Contrato</h1>

<form action="?page=salvarcontrato" method="POST">
    <input type="hidden" name="acaocontrato" value="CadastrarContrato">
    <div class="mb-3">
        <label>Fornecedor</label>

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
        print "<option value='' disabled selected>Selecione o fornecedor</option>";


        while ($row = $res->fetch_object()) {

            print "<option>" . $row->cd_Fornecedor . " - " . $row->nm_Fornecedor . "</option>";

        }
        print "</datalist>";
        print "</select>";
        ?>


    </div>
    <div class="mb-3">
        <label>Data do Contrato</label>
        <input type="number" name="dt_AnoContrato" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação do Contrato</label>
        <input type="text" name="st_Contrato" class="form-control">
    </div>
    <div class="mb-3">
        <label>Serviço</label>
        <input type="text" name="tp_Servico" class="form-control">
    </div>
    <div class="mb-3">
        <label>Data inicial da Obra</label>
        <input type="date" name="dt_Inicial" class="form-control">
    </div>
    <div class="mb-3">
        <label>Data de conclusão da Obra</label>
        <input type="date" name="dt_Final" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>