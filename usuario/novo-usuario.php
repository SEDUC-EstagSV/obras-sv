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
        <input type="tel" name="user_Telefone" class="form-control">
    </div>
    <div class="mb-3">
        <label>Fornecedor</label>

        <?php
        try {
            $sql = "SELECT * FROM fornecedor";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de fornecedores');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }

        print "<select class='form-select' name='cd_Fornecedor'>";
        print "<datalist>";
        print "<option value='' disabled selected>Selecione o fornecedor</option>";


        while ($row = $res->fetch_object()) {

            print "<option value=$row->cd_Fornecedor>" . $row->nm_Fornecedor . "</option>";

        }
        print "</datalist>";
        print "</select>";
        ?>


    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>