<h1>Editar Contrato</h1>

<?php
$sql = "SELECT * FROM contrato WHERE cd_Contrato=" . $_REQUEST["cd_Contrato"];

$res = $conn->query($sql);
$row = $res->fetch_object();
?>

<form action="?page=salvarcontrato" method="POST">
    <input type="hidden" name="acaocontrato" value="editarcontrato">
    <input type="hidden" name="cd_Contrato" value="<?php print $row->cd_Contrato; ?>">
    <div class="mb-3">
        <label>Fornecedor</label>
        <input type="number" name="cd_Fornecedor" value="<?php print $row->cd_Fornecedor; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Ano do Contrato</label>
        <input type="number" name="dt_AnoContrato" value="<?php print $row->dt_AnoContrato; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Tipo de serviço</label>
        <input type="text" name="tp_Servico" value="<?php print $row->tp_Servico; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação do Contrato</label>
        <input type="text" name="st_Contrato" value="<?php print $row->st_Contrato; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Data inicial da Obra</label>
        <input type="date" name="dt_Inicial" value="<?php print $row->dt_Inicial; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Data de conclusão da Obra</label>
        <input type="date" name="dt_Final" value="<?php print $row->dt_Final; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>