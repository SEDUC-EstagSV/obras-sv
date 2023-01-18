<?php
include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);
?>

<h1>Gerenciamento de usuário</h1>

<?php
require_once('function-seduc.php');

$cd_Usuario = $_REQUEST["cd_Usuario"];

try {
    $sql = $conn->prepare("SELECT u.*, f.nm_Fornecedor FROM usuario u INNER JOIN fornecedor f ON u.cd_Fornecedor = f.cd_Fornecedor WHERE u.cd_Usuario = ?");
    $sql->bind_param('i', $cd_Usuario);
    $sql->execute();


    $res = $sql->get_result();
    $row = $res->fetch_object();
} catch (mysqli_sql_exception $e) {
    print "<script>alert('Ocorreu um erro interno ao buscar dados do usuário');
                    window.history.go(-1);</script>";
}
?>

<form action="?page=salvarusuario" method="POST">
    <input type="hidden" name="acaousuario" value="gerenciarusuario">
    <input type="hidden" name="cd_Usuario" value="<?php print $row->cd_Usuario; ?>">
    <div class="mb-3">
        <label>Usuário</label>
        <input type="nome" name="user_Login" value="<?php print $row->user_Login; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nome</label>
        <input type="nome" name="user_Nome" value="<?php print $row->user_Nome; ?>" class="form-control">
    </div>


    <?php
    $atualForn = $row->cd_Fornecedor;
    ?>

    <div class="form-group mb-3">
        <label>Fornecedor</label>
        <select class="form-control" name="cd_Fornecedor">
            <datalist>
                <option disabled selected value=""><?php print "Atual: " . $atualForn = $row->nm_Fornecedor; ?></option>

                <option value="$row->cd_Fornecedor"><?php print "$row->nm_Fornecedor"; ?></option>
            </datalist>
        </select>
    </div>


    <div class="mb-3">
        <label>E-mail</label>
        <input type="text" name="user_Email" value="<?php print $row->user_Email; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Telefone</label>
        <input type="tel" name="user_Telefone" value="<?php print $row->user_Telefone; ?>" class="form-control">
    </div>

    <?php
    $aut = $row->user_Autoridade;
    $formataut = formatarAutoridade($aut);
    ?>

    <div class="mb-3">
        <label>Permissão de usuário</label>
        <select type="number" name="user_Autoridade" class="form-control">
            <option disabled selected value="<?php print $aut; ?>"><?php print "Atual: " . $formataut; ?></option>
            <option value="1">Pendente</option>
            <option value="2">Subordinado</option>
            <option value="3">Supervisor</option>
        </select><br />
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>