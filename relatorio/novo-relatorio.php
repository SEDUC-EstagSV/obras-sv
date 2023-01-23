<h1>Novo Relatório</h1>

<form action="?page=formvalues" id="relatorio_form" method="POST" >
    <input type="hidden" name="acaorelatorio" value="cadastrarRelatorio">
    <div class="mb-3">
        <label>Código da Obra</label>
        <?php
        try {
            $sql = $conn->prepare("SELECT o.*, ohu.cd_Usuario AS cd_Usuarios
            FROM obraview o 
            LEFT JOIN obra_has_usuario ohu
            ON o.cd_Obra = ohu.cd_Obra
            WHERE ohu.cd_Usuario = ?
            GROUP BY o.cd_Obra");

            $sql->bind_param('i', $_SESSION['user'][2]);
            $sql->execute();

            $res = $sql->get_result();
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de situacao de obra');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }
    
        print "<select class='form-select obra' name='cd_Obra' >";
        print "<datalist>";
        print "<option value='' disabled selected>Selecione a situação da obra</option>";

    
        while ($row = $res->fetch_object()) {

            print "<option value={$row->cd_Obra}>$row->tp_Servico: $row->tp_AtividadeDescricao / $row->nm_Escola</option>";

        }
        print "</datalist>";
        print "</select>";
        ?>
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
                <input type='checkbox' name='tp_Periodo[]' value=$row->cd_tipoPeriodo>
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
            print "<option value='' disabled selected>Selecione a situação do clima</option>";


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
            print "<option value='' disabled selected>Selecione a condição do trabalho</option>";


            while ($row = $res->fetch_object()) {

                print "<option value={$row->cd_tipoCondicao}>" . $row->nm_tipoCondicao . "</option>";

            }

            print "</datalist>";
            print "</select>";
        ?>
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
        <label>Fotos</label>
        <input type="file" name="foto[]" class="form-control" multiple>
    </div>  

    <div class="mb-3">
        <button type="submit" id="checkBtn" class="btn btn-primary">Enviar</button>
    </div>
</form>

<script>
//validação formulário
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