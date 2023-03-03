<h1>Validação de Código</h1>

<form action="?page=recuperarusuario" method="POST">
    <input type="hidden" name="acaousuario" value="validarCodigo">
    <div class="mb-3">
        <label>Insira o código enviado no seu email</label>
        <input type="text" name="num_pedido" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </div>
</form>