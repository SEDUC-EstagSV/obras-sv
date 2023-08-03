<style>
    #grid-table>div.row {
        color: black;
        justify-content: center;
    }

    .btn {
        font-size: 15px;
        margin: 1px;
        margin-top: 5px;
        margin-bottom: 25px;
        padding: 5px;
        width: 70px;
    }


    label {
        font-weight: bold;

    }

    #check label {
        font-weight: lighter;


    }


    .caixa {
        font-size: 16px;
        margin-left: 50px;
        margin-right: 80px;
        padding-right: 10px;
        padding-left: 10px;
        margin: 10px;
        margin-bottom: 100px;
    }


    .form-control {
        width: 100%;
        border-radius: 5px;
    }

    #servicos {
        padding: 25px 50px 5px 50px;
    }


    @media (min-width: 992px) {

        .caixa {
            padding-top: 80px;
        }
    }




    @media (max-width: 575.98px) {
        .caixa {
            margin: 10px;
            margin-left: -65px;
            margin-right: -85px;
            font-size: 15px;
            background-color: white;
            font-size: 12px;
            padding: 10px;

        }



        #space {
            padding-top: 25px;
        }






        .btn {
            font-size: 12px;
            margin: 2px;
            margin-top: 0px;
            margin-bottom: 30px;
            padding: 5px;
            width: 46px;

        }



        .form-control {

            width: 100%;
            border-radius: 5px;

        }

        #servicos {
            padding-left: 8px;
            padding-right: 25px;


        }


    }
</style>


<section id="servicos" class="caixa">
    <div class="secao-title">
        <h3>Novo Relatório</h3>
    </div>

    <form action="?page=salvarrelatorio" enctype='multipart/form-data' id="relatorio_form" method="POST">
        <input type="hidden" name="acaorelatorio" value="cadastrarRelatorio">
        <div class="mb-3">
            <label>Referência da Obra</label>
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
            print "<option value='' disabled hidden selected>Selecione o contrato / obra de referência / local</option>";

            if ($res->num_rows > 0) {
                while ($row = $res->fetch_object()) {
                    print "<option value={$row->cd_Obra}>$row->tp_Servico: $row->tp_AtividadeDescricao / $row->nm_Escola</option>";
                }
            } else {
                print "<option disabled>Você ainda não foi vínculado como responsável de uma obra</option>";
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
            <label>E-mail</label>
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
            <label>Período de execução do trabalho</label>
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
            <div id='check'>
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
            <input type="number" name="qt_TotalMaodeObra" class="form-control" value="0">
        </div>
        <div class="mb-3">
            <label>Total de ajudantes</label>
            <input type="number" name="qt_Ajudantes" class="form-control" value="0">
        </div>
        <div class="mb-3">
            <label>Total de eletricistas</label>
            <input type="number" name="qt_Eletricistas" class="form-control" value="0">
        </div>
        <div class="mb-3">
            <label>Total de Mestres de Obra</label>
            <input type="number" name="qt_Mestres" class="form-control" value="0">
        </div>
        <div class="mb-3">
            <label>Total de pedreiros</label>
            <input type="number" name="qt_Pedreiros" class="form-control" value="0">
        </div>
        <div class="mb-3">
            <label>Total de serventes</label>
            <input type="number" name="qt_Serventes" class="form-control" value="0">
        </div>
        <div class="mb-3">
            <label>Total de Mão Direta</label>
            <input type="number" name="qt_MaoDireta" class="form-control" value="0">
        </div>

        <div class="mb-3">
            <label id="valorAndamento" class="form-label">Porcentagem concluida</label>
            <div class="slidecontainer">
                <input type="range" name="pt_Conclusao" class="form-range" min='0' max='100' step='5' id='sliderAndamento' value='0'>
            </div>
        </div>

        <div class="mb-3">
            <label>Comentário</label>
            <input type="text" name="tp_RelaComentario" class="form-control">
        </div>
        <div class="mb-3">
            <label for='formFile' class='form-label'>Fotos</label>
            <input id='formFile' type="file" name="foto[]" class="form-control" multiple>
        </div>


        <div class="mb-3">
            <button type="submit" id="checkBtn" class="btn btn-primary">Enviar</button>
        </div>
    </form>

</section>

<script type="module">
    import {
        validateTextInput,
        validateNumberInput
    } from './js/validators.js';
    //validação formulário
    const form = document.querySelector('#relatorio_form');

    function validateCheckboxes() {
        const checkboxes = document.querySelectorAll('input[type=checkbox]');

        var empty = [].filter.call(checkboxes, function(el) {
            return !el.checked
        });

        if (checkboxes.length == empty.length) {
            //alert("É necessário informar pelo menos um período de trabalho");
            return false;
        } else {
            return true;
        }
    }

    function validateInputs() {
        const isValid = {
            value: false,
            error: ''
        };

        const cdObra = document.getElementsByName('cd_Obra')[0].value;
        const tecResponsavel = document.getElementsByName('nm_TecResponsavel')[0].value;
        const email = document.getElementsByName('ds_Email')[0].value;
        const responsavelLocal = document.getElementsByName('nm_LocResponsavel')[0].value;
        const ativRealizada = document.getElementsByName('tp_AtivRealizada')[0].value;
        const cdTempo = document.getElementsByName('tp_Tempo')[0].value;
        const cdCondicao = document.getElementsByName('tp_Condicao')[0].value;
        const totalMaoObra = document.getElementsByName('qt_TotalMaodeObra')[0].value;
        const qtAjudantes = document.getElementsByName('qt_Ajudantes')[0].value;
        const qtEletricistas = document.getElementsByName('qt_Eletricistas')[0].value;
        const qtMestres = document.getElementsByName('qt_Mestres')[0].value;
        const qtPedreiros = document.getElementsByName('qt_Pedreiros')[0].value;
        const qtServentes = document.getElementsByName('qt_Serventes')[0].value;
        const qtMaoDireita = document.getElementsByName('qt_MaoDireta')[0].value;
        const qtConclusao = document.getElementsByName('pt_Conclusao')[0].value;

        const isFilled = validateNumberInput(cdObra) &&
            validateTextInput(tecResponsavel) &&
            validateTextInput(email) &&
            validateTextInput(responsavelLocal) &&
            validateTextInput(ativRealizada) &&
            validateNumberInput(cdTempo) &&
            validateNumberInput(cdCondicao) &&
            validateNumberInput(totalMaoObra) &&
            validateNumberInput(qtAjudantes) &&
            validateNumberInput(qtEletricistas) &&
            validateNumberInput(qtMestres) &&
            validateNumberInput(qtPedreiros) &&
            validateNumberInput(qtServentes) &&
            validateNumberInput(qtMaoDireita) &&
            validateNumberInput(qtConclusao);

        let checkTotalMaoObra = false;

        if (isFilled) {
            checkTotalMaoObra =
                parseInt(qtAjudantes) +
                parseInt(qtEletricistas) +
                parseInt(qtMestres) +
                parseInt(qtPedreiros) +
                parseInt(qtServentes) +
                parseInt(qtMaoDireita) ==
                parseInt(totalMaoObra);
            if (!checkTotalMaoObra) {
                isValid.error = "A quantidade do total de mão de obra não confere com a quantidade de trabalhadores informados";
            }
        }
        isValid.value = isFilled && checkTotalMaoObra;
        return isValid;
    }


    form.addEventListener('submit', function(e) {
        // prevent the form from submitting
        e.preventDefault();

        // validate fields
        const checkboxes = validateCheckboxes();
        const inputs = validateInputs();

        const isFormValid = checkboxes && inputs.value;

        // submit to the server if the form is valid
        if (isFormValid) {
            form.submit();
        } else {
            alert(inputs.error != '' ? inputs.error : "Certifique-se de preencher todos os campos necessários")
        }
    });
</script>

<script type="text/javascript">
    //Código Javascript para atualização de valor do Slider(Andamento da obra)
    var slider = document.getElementById('sliderAndamento');
    var output = document.getElementById('valorAndamento');
    output.innerHTML = slider.value + "%";

    slider.oninput = function() {
        output.innerHTML = this.value + "%";
    }
</script>