<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Nova obra</h1>

<form action="?page=salvarobra" method="POST">
    <input type="hidden" name="acaoobra" value="cadastrarObra">
    <div class="mb-3">
        <label>Nome da Obra</label>
        <input type="nome" name="nm_Obra" class="form-control">
    </div>
    <div class="mb-3">
        <label>Escola</label>
        <input type="number" name="cd_Escola" class="form-control">
    </div>
    <div class="mb-3">
        <label>Contrato</label>
        <input type="number" name="cd_Contrato" class="form-control">
    </div>
    <div class="mb-3">
        <label>Contratante</label>
        <input type="nome" name="nm_Contratante" class="form-control">
    </div>
    <div class="mb-3">
        <label>Descrição da Atividade</label>
        <input type="text" name="tp_AtivDescricao" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação da Obra</label>
        <input type="text" name="st_Obra" class="form-control">
    </div>
    <div class="mb-3">
        <label>Comentário</label>
        <input type="text" name="tp_Comentario" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>