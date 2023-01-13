<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Novo Fornecedor</h1>

<form action="?page=salvarfornecedor" method="POST">
    <input type="hidden" name="acaofornecedor" value="CadastrarFornecedor">
    <div class="mb-3">
        <label>Nome fornecedor</label>
        <input type="nome" name="nm_Fornecedor" class="form-control">
    </div>
    <div class="mb-3">
        <label>CNPJ</label>
        <input type="text" name="num_CNPJ" class="form-control">
    </div>
    <div class="mb-3">
        <label>E-mail</label>
        <input type="email" name="ds_Email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Endereço</label>
        <input type="text" name="ds_Endereco" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação do Fornecedor</label>
        <input type="text" name="st_Fornecedor" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>