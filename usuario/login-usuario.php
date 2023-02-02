<h1>Login</h1>

<form action="?page=salvarusuario" method="POST">
    <input type="hidden" name="acaousuario" value="loginusuario">
    <div class="mb-3">
        <label>Nome de Usuário</label>
        <input type="name" name="user_Login" class="form-control">
    </div>
    <div class="mb-3">
        <label>Senha</label>
        <div class="input-group">
            <input type="password" name="user_Senha" class="form-control" id="senha" autocomplete="off">
            <i class="input-group-text bi bi-eye-slash" id="viewSenha"></i>
        </div>
        <a href="?page=pedidorecuperacao">Esqueci minha senha</a>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </div>
    <a href="?page=novousuario">Não tem uma conta?</a>
</form>
<script>
        const viewSenha = document.querySelector("#viewSenha");
        const senha = document.querySelector("#senha");

        viewSenha.addEventListener("click", function () {
            // Alterar o atributo "type"
            const type = senha.getAttribute("type") === "password" ? "text" : "password";
            senha.setAttribute("type", type);
            
            // Alterar ícone
            this.classList.toggle("bi-eye");
        });
  </script>