<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Criar nova conta</h1>

<form action="?page=salvarusuario" method="POST">
    <input type="hidden" name="acaousuario" value="cadastrarUsuario">
    <div class="mb-3">
        <label>Nome de Usuário</label>
        <input type="name" name="user_Login" class="form-control">
    </div>
    <div class="mb-3">
        <label>Senha</label>
        <input type="password" name="user_Senha" class="form-control">
    </div>
    <div class="mb-3">
        <label>Confirmar Senha</label>
        <input type="password" name="user_Senha2" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nome completo</label>
        <input type="name" name="user_Nome" class="form-control">
    </div>
    <div class="mb-3">
        <label>CPF</label>
        <input type="text" name="user_CPF" class="form-control">
    </div>
    <div class="mb-3">
        <label>E-mail</label>
        <input type="text" name="user_Email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Celular / Telefone</label>
        <input type="text" name="user_Telefone" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>