<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>


<h1>Editar obra</h1>

<?php
$cd_Relatorio = $_REQUEST["cd_Relatorio"];

try{
    $sql = $conn->prepare("SELECT * FROM relatorioview WHERE cd_Relatorio= ?");
    $sql->bind_param('i', $cd_Relatorio);
    $sql->execute();
    $res = $sql->get_result();
    
    $rowRelatorio = $res->fetch_object();

    $periodos = $rowRelatorio->Periodo;
} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados do relatório');
                    window.history.go(-1);</script>";
    criaLogErro($e);
}

?>

<form action="?page=salvarrelatorio" method="POST">
    <input type="hidden" name="acaorelatorio" value="editarrelatorio">
    <input type="hidden" name="cd_Relatorio" value="<?php print $rowRelatorio->cd_Relatorio; ?>">
    <div class="mb-3">
        <label>Código da Obra</label>
        <input type="number" name="cd_Obra" value="<?php echo $rowRelatorio->cd_Obra ?>" class="form-control" readonly>
    </div>
    <div class="mb-3">
        <label>Nome do Técnico Responsável</label>
        <input type="name" name="nm_TecResponsavel" value="<?php echo $rowRelatorio->nm_TecResponsavel ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="text" name="ds_Email" value="<?php echo $rowRelatorio->ds_Email_TecResponsavel ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nome do Responsável pelo Local</label>
        <input type="name" name="nm_LocResponsavel" value="<?php echo $rowRelatorio->nm_LocResponsavel ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Atividade realizada</label>
        <input type="text" name="tp_AtivRealizada" value="<?php echo $rowRelatorio->tp_AtivRealizada ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação do Relatório</label>
        <?php


        try {
            $sql = "SELECT * FROM situacao_relatorio";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de periodos');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }


        print "<select class='form-select situacao' name='tp_RelaSituacao' >";
        print "<datalist>";
        print "<option value='$rowRelatorio->cd_situacaoRelatorio' readonly selected>$rowRelatorio->nm_situacaoRelatorio</option>";


        while ($row = $res->fetch_object()) {

            print "<option value={$row->cd_situacaoRelatorio}>" . $row->nm_situacaoRelatorio . "</option>";

        }

        print "</datalist>";
        print "</select>";

        ?>
    </div>
    <div class="mb-3">
        <label>Período trabalho</label>
        <?php
        try {
            $sql = "SELECT * FROM tipo_periodo";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de periodos');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }


        while ($row = $res->fetch_object()) {
            print "
            <div>";
            if(str_contains($periodos, $row->nm_tipoPeriodo)){
                print "<input type='checkbox' name='tp_Periodo[]' value=$row->cd_tipoPeriodo checked>";
            } else {
                print "<input type='checkbox' name='tp_Periodo[]' value=$row->cd_tipoPeriodo>";
            }
            print "    
                <label for='tp_Periodo'>$row->nm_tipoPeriodo</label>
            </div>";

        }
        ?>
    </div>
    <div class="mb-3">
        <label>Clima</label>

        <?php
        
            try {
                $sql = "SELECT * FROM tipo_tempo";

                $res = $conn->query($sql);
            } catch (mysqli_sql_exception $e) {
                print "<script>alert('Ocorreu um erro interno ao buscar dados de formulario');
                        location.href='painel.php';</script>";
                criaLogErro($e);
            }

            print "<select class='form-select tempo' name='tp_Tempo' >";
            print "<datalist>";
            print "<option value=$rowRelatorio->cd_tipoTempo readonly selected>$rowRelatorio->nm_tipoTempo</option>";


            while ($row = $res->fetch_object()) {

                print "<option value={$row->cd_tipoTempo}>" . $row->nm_tipoTempo . "</option>";

            }

            print "</datalist>";
            print "</select>";
        ?>
    </div>
    <div class="mb-3">
        <label>Condição para trabalho</label>
        <?php
    
            try {
                $sql = "SELECT * FROM tipo_condicao";

                $res = $conn->query($sql);
            } catch (mysqli_sql_exception $e) {
                print "<script>alert('Ocorreu um erro interno ao buscar dados de formulario');
                        location.href='painel.php';</script>";
                criaLogErro($e);
            }

            print "<select class='form-select condicao' name='tp_Condicao' >";
            print "<datalist>";
            print "<option value=$rowRelatorio->cd_tipoCondicao readonly selected>$rowRelatorio->nm_tipoCondicao</option>";


            while ($row = $res->fetch_object()) {

                print "<option value={$row->cd_tipoCondicao}>" . $row->nm_tipoCondicao . "</option>";

            }

            print "</datalist>";
            print "</select>";
        ?>
    </div>
    <div class="mb-3">
        <label>Total de Mão de obra</label>
        <input type="number" value='<?php echo $rowRelatorio->qt_totalMaoDeObra ?>' name="qt_TotalMaodeObra" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de ajudantes</label>
        <input type="number" value='<?php echo $rowRelatorio->qt_Ajudantes ?>' name="qt_Ajudantes" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de eletricistas</label>
        <input type="number" value='<?php echo $rowRelatorio->qt_Eletricistas ?>' name="qt_Eletricistas" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mestres de Obra</label>
        <input type="number" value='<?php echo $rowRelatorio->qt_Mestres ?>' name="qt_Mestres" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de pedreiros</label>
        <input type="number" value='<?php echo $rowRelatorio->qt_Pedreiros ?>' name="qt_Pedreiros" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de serventes</label>
        <input type="number" value='<?php echo $rowRelatorio->qt_Serventes ?>' name="qt_Serventes" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mão Direta</label>
        <input type="number" value='<?php echo $rowRelatorio->qt_MaoDireta ?>' name="qt_MaoDireta" class="form-control">
    </div>
    <div class="mb-3">
        <label>Porcentagem concluida</label>
        <input type="number" value='<?php echo $rowRelatorio->pt_Conclusao ?>' name="pt_Conclusao" class="form-control">
    </div>
    <div class="mb-3">
        <label>Comentário</label>
        <input type="text" value='<?php echo $rowRelatorio->tp_Comentario ?>' name="tp_RelaComentario" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>