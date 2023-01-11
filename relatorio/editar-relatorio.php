<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>


<h1>Editar obra</h1>

<?php
$cd_Relatorio = $_REQUEST["cd_Relatorio"];

try{
    $sql = $conn->prepare("SELECT * FROM relatorio WHERE cd_Relatorio= ?");
    $sql->bind_param('i', $cd_Relatorio);
    $sql->execute();
    $res = $sql->get_result();
    
    $row = $res->fetch_object();
} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados do relatório');
                    window.history.go(-1);</script>";
    criaLogErro($e);
}

?>

<form action="?page=salvarrelatorio" method="POST">
    <input type="hidden" name="acaorelatorio" value="editarrelatorio">
    <input type="hidden" name="cd_Relatorio" value="<?php print $row->cd_Relatorio; ?>">
    <div class="mb-3">
        <label>Código da Obra</label>
        <input type="number" name="cd_Obra" value="<?php print $row->cd_Obra; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>N° do Relatório nessa obra</label>
        <input type="number" name="num_Relatorio" value="<?php print $row->num_Relatorio; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nome do Técnico Responsável</label>
        <input type="name" name="nm_TecResponsavel" value="<?php print $row->nm_TecResponsavel; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="text" name="ds_Email" value="<?php print $row->ds_Email; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nome do Responsável pelo Local</label>
        <input type="name" name="nm_LocResponsavel" value="<?php print $row->nm_LocResponsavel; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Atividade realizada</label>
        <input type="text" name="tp_AtivRealizada" value="<?php print $row->tp_AtivRealizada; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação do Relatório</label>
        <input type="number" name="tp_RelaSituacao" value="<?php print $row->tp_RelaSituacao; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Dias da semana trabalhados</label>
        <input type="text" name="nm_Dia" value="<?php print $row->nm_Dia; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Período trabalho</label>
        <input type="text" name="tp_Periodo" value="<?php print $row->tp_Periodo; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Clima</label>
        <input type="text" name="tp_Tempo" value="<?php print $row->tp_Tempo; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Condição para trabalho</label>
        <input type="text" name="tp_Condicao" value="<?php print $row->tp_Condicao; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mão de obra</label>
        <input type="number" name="qt_TotalMaodeObra" value="<?php print $row->qt_TotalMaodeObra; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de ajudantes</label>
        <input type="number" name="qt_Ajudantes" value="<?php print $row->qt_Ajudantes; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de eletricistas</label>
        <input type="number" name="qt_Eletricistas" value="<?php print $row->qt_Eletricistas; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mestres de Obra</label>
        <input type="number" name="qt_Mestres" value="<?php print $row->qt_Mestres; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de pedreiros</label>
        <input type="number" name="qt_Pedreiros" value="<?php print $row->qt_Pedreiros; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de serventes</label>
        <input type="number" name="qt_Serventes" value="<?php print $row->qt_Serventes; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mão Direta</label>
        <input type="number" name="qt_MaoDireta" value="<?php print $row->qt_MaoDireta; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Porcentagem concluida</label>
        <input type="number" name="pt_Conclusao" value="<?php print $row->pt_Conclusao; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Comentário</label>
        <input type="text" name="tp_RelaComentario" value="<?php print $row->tp_RelaComentario; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>