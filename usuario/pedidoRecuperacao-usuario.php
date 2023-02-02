<h1>Solicitar Recuperação de Senha</h1>
<p>Enviaremos um código no seu email para validar a solicitação</p>

<form action="?page=recuperarusuario" method="POST">
    <input type="hidden" name="acaousuario" value="pedidoRecuperacao">
    <div class="mb-3">
        <label>Insira seu email</label>
        <input type="email" name="user_Email" class="form-control">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>