<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Nova Escola</h1>

<form action="?page=salvarescola" method="POST">
    <input type="hidden" name="acaoescola" value="cadastrarEscola">
    <div class="mb-3">
        <label>Nome da Escola</label>
        <input type="nome" name="nm_Escola" class="form-control">
    </div>
    <div class="mb-3">
        <label>Endereço da Escola</label>
        <input type="text" name="ds_Local" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação da Escola</label>
        <select name="st_Escola">
            <option>Ativa</option>
            <option>Desativada</option>
        </select>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>