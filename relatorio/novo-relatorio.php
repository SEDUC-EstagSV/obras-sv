<h1>Novo Relatório</h1>

<form action="?page=salvarrelatorio" id="relatorio_form" method="POST" >
    <input type="hidden" name="acaorelatorio" value="cadastrarRelatorio">
    <div class="mb-3">
        <label>Código da Obra</label>
        <input type="number" name="cd_Obra" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nome do Técnico Responsável</label>
        <input type="name" name="nm_TecResponsavel" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="text" name="ds_Email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nome do Responsável pelo Local</label>
        <input type="name" name="nm_LocResponsavel" class="form-control">
    </div>
    <div class="mb-3">
        <label>Atividade realizada</label>
        <input type="text" name="tp_AtivRealizada" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação do Relatório</label>
        <input type="text" name="tp_RelaSituacao" class="form-control">
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
            <div>
                <input type='checkbox' name='periodo_$row->cd_tipoPeriodo'>
                <label for='periodo_$row->cd_tipoPeriodo'>$row->nm_tipoPeriodo</label>
            </div>";

        }

        ?>
    </div>
    <div class="mb-3">
        <label>Clima</label>
        <input type="text" name="tp_Tempo" class="form-control">
    </div>
    <div class="mb-3">
        <label>Condição para trabalho</label>
        <input type="text" name="tp_Condicao" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mão de obra</label>
        <input type="number" name="qt_TotalMaodeObra" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de ajudantes</label>
        <input type="number" name="qt_Ajudantes" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de eletricistas</label>
        <input type="number" name="qt_Eletricistas" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mestres de Obra</label>
        <input type="number" name="qt_Mestres" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de pedreiros</label>
        <input type="number" name="qt_Pedreiros" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de serventes</label>
        <input type="number" name="qt_Serventes" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mão Direta</label>
        <input type="number" name="qt_MaoDireta" class="form-control">
    </div>
    <div class="mb-3">
        <label>Porcentagem concluida</label>
        <input type="number" name="pt_Conclusao" class="form-control">
    </div>
    <div class="mb-3">
        <label>Comentário</label>
        <input type="text" name="tp_RelaComentario" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" id="checkBtn" class="btn btn-primary">Enviar</button>
    </div>
</form>

<script>
const form = document.querySelector('#relatorio_form');

function validateCheckboxes(){
    const checkboxes = document.querySelectorAll('input[type=checkbox]');

    var empty = [].filter.call(checkboxes, function( el ) {
        return !el.checked
    });

    if (checkboxes.length == empty.length) {
        alert("É necessário informar pelo menos um período de trabalho");
        return false;
    } else {
        return true;
    }
}


form.addEventListener('submit', function (e) {
    // prevent the form from submitting
    e.preventDefault();

    // validate fields
    const checkboxes = validateCheckboxes();

    isFormValid = checkboxes;

    // submit to the server if the form is valid
    if (isFormValid) {
        form.submit();
    }
});

</script>