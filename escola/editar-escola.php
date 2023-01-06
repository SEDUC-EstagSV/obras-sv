<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Editar obra</h1>

<?php
$sql = "SELECT * FROM escola WHERE cd_Escola=" . $_REQUEST["cd_Escola"];

$res = $conn->query($sql);
$row = $res->fetch_object();
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