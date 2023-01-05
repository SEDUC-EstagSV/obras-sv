<?php
    include_once('function-seduc.php');

    confereAutoridade();
?>

<h1>Novo Contrato</h1>

<form action="?page=salvarcontrato" method="POST">
    <input type="hidden" name="acaocontrato" value="CadastrarContrato">
    <div class="mb-3">
        <label>Fornecedor</label>
        <input type="number" name="cd_Fornecedor" class="form-control">
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