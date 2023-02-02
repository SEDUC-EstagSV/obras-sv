<h1>Recuperar Senha</h1>

<form action="?page=recuperarusuario" method="POST">
    <input type="hidden" name="acaousuario" value="recuperarSenha">
    <div class="mb-3">
        <label>Senha</label>
        <input type="password" name="user_Senha1" class="form-control">
    </div>
    <div class="mb-3">
        <label>Confirmar senha</label>
        <input type="password" name="user_Senha2" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </div>
</form>