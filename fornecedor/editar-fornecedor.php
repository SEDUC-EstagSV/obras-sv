<?php
    include_once('function-seduc.php');

    confereAutoridade();
?>

<h1>Editar fornecedor</h1>

<?php
$sql = "SELECT * FROM fornecedor WHERE cd_Fornecedor=" . $_REQUEST["cd_Fornecedor"];

$res = $conn->query($sql);
$row = $res->fetch_object();
?>

<form action="?page=salvarfornecedor" method="POST">
    <input type="hidden" name="acaofornecedor" value="editarfornecedor">
    <input type="hidden" name="cd_Fornecedor" value="<?php print $row->cd_Fornecedor; ?>">
    <div class="mb-3">
        <label>Nome fornecedor</label>
        <input type="nome" name="nm_Fornecedor" value="<?php print $row->nm_Fornecedor; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="ds_Email" value="<?php print $row->ds_Email; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Endereço</label>
        <input type="text" name="ds_Endereco" value="<?php print $row->ds_Endereco; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>CNPJ</label>
        <input type="text" name="num_CNPJ" value="<?php print $row->num_CNPJ; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação atual</label>
        <input type="text" name="st_Fornecedor" value="<?php print $row->st_Fornecedor; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>