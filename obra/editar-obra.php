<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Editar obra</h1>

<?php
$cd_Obra = $_REQUEST["cd_Obra"];

try{
    $sql = $conn->prepare("SELECT * FROM obra WHERE cd_Obra= ?");
    $sql->bind_param('i', $cd_Obra);
    $sql->execute();
    $res = $sql->get_result();
    
    $row = $res->fetch_object();
} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados da obra');
                    window.history.go(-1);</script>";
}
?>

<form action="?page=salvarobra" method="POST">
    <input type="hidden" name="acaoobra" value="editarobra">
    <input type="hidden" name="cd_Obra" value="<?php print $row->cd_Obra; ?>">
    <div class="mb-3">
        <label>Nome da obra</label>
        <input type="nome" name="nm_Obra" value="<?php print $row->nm_Obra; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Código da Escola</label>
        <input type="number" name="cd_Escola" value="<?php print $row->cd_Escola; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>N° do Contrato</label>
        <input type="number" name="cd_Contrato" value="<?php print $row->cd_Contrato; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Contratante</label>
        <input type="nome" name="nm_Contratante" value="<?php print $row->nm_Contratante; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação da Obra</label>
        <input type="text" name="st_Obra" value="<?php print $row->st_Obra; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Descrição da Atividade</label>
        <input type="text" name="tp_AtivDescricao" value="<?php print $row->tp_AtivDescricao; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Comentários</label>
        <input type="text" name="tp_Comentario" value="<?php print $row->tp_Comentario; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>