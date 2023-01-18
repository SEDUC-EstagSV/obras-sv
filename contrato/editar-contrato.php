<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Editar Contrato</h1>

<?php
try{
    $cd_Contrato = $_REQUEST["cd_Contrato"];
    $sql = $conn->prepare("SELECT * FROM contratoview c WHERE cd_Contrato = ?");
    $sql->bind_param('i', $cd_Contrato);
    $sql->execute();
    $res = $sql->get_result();
    $rowRelatorio = $res->fetch_object();

} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados do contrato');
                    window.history.go(-1);</script>";
    criaLogErro($e);
}   
?>

<form action="?page=salvarcontrato" method="POST">
    <input type="hidden" name="acaocontrato" value="editarcontrato">
    <input type="hidden" name="cd_Contrato" value="<?php print $rowRelatorio->cd_Contrato; ?>">
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
        print "<option value=$rowRelatorio->cd_Fornecedor readonly selected>$rowRelatorio->nm_Fornecedor</option>";


        while ($row = $res->fetch_object()) {

            print "<option value=$row->cd_Fornecedor>" . $row->nm_Fornecedor . "</option>";

        }
        print "</datalist>";
        print "</select>";
        ?>
    </div>
    <div class="mb-3">
        <label>Ano do Contrato</label>
        <input type="number" name="dt_AnoContrato" value="<?php print $rowRelatorio->dt_AnoContrato; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Tipo de serviço</label>
        <input type="text" name="tp_Servico" value="<?php print $rowRelatorio->tp_Servico; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação do Contrato</label>
        <?php


        try {
            $sql = "SELECT * FROM situacao_contrato";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de situacao');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }


        print "<select class='form-select situacao' name='st_Contrato' >";
        print "<datalist>";
        print "<option value='$rowRelatorio->cd_situacao' readonly selected style='background-color:#C0C0C0;'>$rowRelatorio->nm_situacao</option>";


        while ($row = $res->fetch_object()) {

            print "<option value={$row->cd_situacao}>" . $row->nm_situacao . "</option>";

        }

        print "</datalist>";
        print "</select>";

        ?>
    </div>
    <div class="mb-3">
        <label>Data inicial da Obra</label>
        <input type="date" name="dt_Inicial" value="<?php print $rowRelatorio->dt_Inicial; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Data de conclusão da Obra</label>
        <input type="date" name="dt_Final" value="<?php print $rowRelatorio->dt_Final; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>