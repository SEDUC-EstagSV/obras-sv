<h1>Login</h1>

<form action="?page=salvarusuario" method="POST">
    <input type="hidden" name="acaousuario" value="loginusuario">
    <div class="mb-3">
        <label>Nome de Usuário</label>
        <input type="name" name="user_Login" class="form-control">
    </div>
    <div class="mb-3">
        <label>Senha</label>
        <input type="password" name="user_Senha" class="form-control">
        <a href="?page=recuperarusuario">Esqueci minha senha</a>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </div>
    <a href="?page=novousuario">Não tem uma conta?</a>
</form>