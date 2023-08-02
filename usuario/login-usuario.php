<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="container">
    <section class="caixa bg-light">

        <div class="container-fluid">


            <div class="row">
                <div class="col mt-3">



                    <div>

                        <h3>Login</h3>

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
                            <div class="g-recaptcha" data-sitekey="6LdSzS0mAAAAABtE3DZ_UgNueyMSKuabh0O4jhnQ"></div>
                            <div id="botaoLogin" class="mb-3">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>




                </div>
            </div>

        </div>

    </section>

</div>

</div><!--/container -->

</section><!--/home -->




<script>
    const viewSenha = document.querySelector("#viewSenha");
    const senha = document.querySelector("#senha");

    viewSenha.addEventListener("click", function() {
        // Alterar o atributo "type"
        const type = senha.getAttribute("type") === "password" ? "text" : "password";
        senha.setAttribute("type", type);

        // Alterar ícone
        this.classList.toggle("bi-eye");
    });
</script>