<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Editar usuário</h1>

<?php
require_once('function-seduc.php');
$cd_Usuario = $_REQUEST["cd_Usuario"];

try{
    $sql = $conn->prepare("SELECT * FROM usuario WHERE cd_Usuario = ?");
    $sql->bind_param('i', $cd_Usuario);
    $sql->execute();
    
    $res = $sql->get_result();
    $row = $res->fetch_object();

} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados do usuário');
                    window.history.go(-1);</script>";
    criaLogErro($e);
}
?>

<form action="?page=salvarusuario" method="POST">
    <input type="hidden" name="acaousuario" value="editarusuario">
    <input type="hidden" name="cd_Usuario" value="<?php print $row->cd_Usuario; ?>">
    <div class="mb-3">
        <label>Nome de Usuario</label>
        <input type="nome" name="user_Login" value="<?php print $row->user_Login; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Senha atual</label>
        <input type="password" name="user_SenhaAntiga" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nova Senha</label>
        <input type="password" name="user_Senha" class="form-control">
    </div>
    <div class="mb-3">
        <label>Confirmar Senha</label>
        <input type="password" name="user_Senha2" class="form-control">
    </div>
    <div class="mb-3">
        <label>Seu nome</label>
        <input type="nome" name="user_Nome" value="<?php print $row->user_Nome; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>E-mail</label>
        <input type="text" name="user_Email" value="<?php print $row->user_Email; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" name="user_Telefone" value="<?php print $row->user_Telefone; ?>" class="form-control">
    </div>

    <?php
    $aut = $row->user_Autoridade;
    $formataut = formatarAutoridade($aut);
    ?>

    <div class="mb-3">
        <label>Permissão de usuário</label>
        <?php
        try {
            $sql = "SELECT * FROM nivel_autoridade";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de usuário');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }

        print "<select class='form-select' name='user_Autoridade'>";
        print "<datalist>";
        print "<option value=$row->cd_nivelAutoridade readonly selected>$row->nm_nivelAutoridade</option>";


        while ($rowAutoridade = $res->fetch_object()) {

            print "<option value=$rowAutoridade->cd_nivelAutoridade>" . $rowAutoridade->nm_nivelAutoridade . "</option>";

        }
        print "</datalist>";
        print "</select>";
        ?>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>