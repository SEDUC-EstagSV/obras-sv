<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Editar obra</h1>

<?php
$cd_Escola = $_REQUEST["cd_Escola"];

try{
    $sql = $conn->prepare("SELECT * FROM escola WHERE cd_Escola = ?");
    $sql->bind_param('i', $cd_Escola);
    $sql->execute();
    
    $res = $sql->get_result();
    $row = $res->fetch_object();

} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados da escola');
                        window.history.go(-1);</script>";
}
?>

<form action="?page=salvarescola" method="POST">
    <input type="hidden" name="acaoescola" value="editarescola">
    <input type="hidden" name="cd_Escola" value="<?php print $row->cd_Escola; ?>">
    <div class="mb-3">
        <label>Nome da Escola</label>
        <input type="nome" name="nm_Escola" value="<?php print $row->nm_Escola; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Endereço</label>
        <input type="text" name="ds_Local" value="<?php print $row->ds_Local; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação</label>
        <select name="st_Escola" value="<?php print $row->st_Escola; ?>" class="form-control">>
            <option>Ativa</option>
            <option>Desativada</option>
        </select>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>