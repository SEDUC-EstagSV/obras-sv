<style>
 
 #grid-table>div.row{
  color: black;
  justify-content: center;
}

.btn {
    font-size: 15px;
    margin: 1px;
    margin-top: 2px;
    margin-bottom: 5px;
    padding: 3px;
    width: 60px;
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
    padding: 25px;
}


@media (min-width: 992px) { 

.caixa {
    padding-top: 80px;
    }
}

@media (max-width: 575.98px) {
.caixa {
    margin: 16px;
    margin-left: -55px;
    margin-right: -65px;
    font-size: 9px;
    background-color: white;
    padding: 25px 8px 20px 10px;
}

.btn {
    font-size: 9px;
    margin: 3px;
    margin-top: 0px;
    padding: 5px;
    width: 40px;
}

div.col {
  margin: auto;
  width: 100%;
  word-break: break-word;
  padding: 10 0 10 0;
  padding: 2px;
}

#servicos {
    padding: 10px 5px 2px 1px;
}

}

</style>

<?php
include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);
?>
<section id="servicos" class="caixa">
<div>
    <div>
        <h3>Editar Contrato</h3>
    </div>
<div>


<?php
try {
    $cd_Contrato = $_REQUEST["cd_Contrato"];
    $sql = $conn->prepare("SELECT c.*, GROUP_CONCAT(ehc.cd_Escola SEPARATOR ', ') AS cd_Escolas 
                            FROM contratoview c
                            INNER JOIN escola_has_contrato ehc
                            ON c.cd_Contrato = ehc.cd_Contrato
                            WHERE c.cd_Contrato = ?
                            GROUP BY c.cd_Contrato");
    $sql->bind_param('i', $cd_Contrato);
    $sql->execute();
    $res = $sql->get_result();
    $rowContrato = $res->fetch_object();
} catch (mysqli_sql_exception $e) {
    print "<script>alert('Ocorreu um erro interno ao buscar dados do contrato');
                    window.history.go(-1);</script>";
    criaLogErro($e);
}
?>

<form action="?page=salvarcontrato" method="POST">
    <input type="hidden" name="acaocontrato" value="editarcontrato">
    <input type="hidden" name="cd_Contrato" value="<?php print $rowContrato->cd_Contrato; ?>">
    <div class="mb-3">
        <label>Fornecedor</label>
        <?php
        try {
            $sql = "SELECT * FROM fornecedor";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de fornecedores');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }

        print "<select class='form-select' name='cd_Fornecedor'>";
        print "<datalist>";
        print "<option value=$rowContrato->cd_Fornecedor readonly selected hidden>$rowContrato->nm_Fornecedor</option>";


        while ($row = $res->fetch_object()) {

            print "<option value=$row->cd_Fornecedor>" . $row->nm_Fornecedor . "</option>";
        }
        print "</datalist>";
        print "</select>";
        ?>
    </div>
    <div class="mb-3">
        <label>Ano do Contrato</label>
        <input type="number" name="dt_AnoContrato" value="<?php print $rowContrato->dt_AnoContrato; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Tipo de serviço</label>
        <input type="text" name="tp_Servico" value="<?php print $rowContrato->tp_Servico; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação do Contrato</label>
        <?php


        try {
            $sql = "SELECT * FROM situacao_contrato";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de situacao');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }


        print "<select class='form-select situacao' name='st_Contrato' >";
        print "<datalist>";
        print "<option value='$rowContrato->cd_situacao' readonly selected hidden>$rowContrato->nm_situacao</option>";


        while ($row = $res->fetch_object()) {

            print "<option value={$row->cd_situacao}>" . $row->nm_situacao . "</option>";
        }

        print "</datalist>";
        print "</select>";

        ?>
    </div>

    <?php
    //***Variável abaixo para receber valor da data e hora do Banco de Dados***
    $dataParaMudarInicial = $rowContrato->dt_Inicial;
    $dataParaMudarFinal = $rowContrato->dt_Final;

    //***Variável abaixo para receber o valor e alterar para formatação brasileira***
    $dataFormatadaInicial = DateTime::createFromFormat("Y-m-d H:i:s", $dataParaMudarInicial);
    $dataFormatadaFinal = DateTime::createFromFormat("Y-m-d H:i:s", $dataParaMudarFinal);
    ?>


    <div class="mb-3">
        <label>Data inicial da Obra</label>
        <input type="date" name="dt_Inicial" value="<?php print $dataFormatadaInicial->format('Y-m-d'); ?>" class="form-control">

    </div>

    <div class="mb-3">
        <label>Data de conclusão da Obra</label>
        <input type="date" name="dt_Final" value="<?php print $dataFormatadaFinal->format('Y-m-d'); ?>" class="form-control">
    </div>

    <select class="selectpicker mb-3" id="select" name="escolas[]" multiple data-live-search="true" 
    title="Selecione escolas vinculadas a este contrato" 
    data-selected-text-format="count" data-width="auto"
    data-count-selected-text="Escolas selecionadas: {0}"
>
        <datalist>
            <?php
            try {
                $sql = "SELECT * FROM escola";

                $res = $conn->query($sql);
            } catch (mysqli_sql_exception $e) {
                print "<script>alert('Ocorreu um erro interno ao buscar dados de escolas');
                        location.href='painel.php';</script>";
                criaLogErro($e);
            }

            $escolasNoContrato = explode(", ", $rowContrato->cd_Escolas);
            while ($rowEscola = $res->fetch_object()) {
                $escolaEstaNoContrato = false;

                foreach ($escolasNoContrato as $cd_escolaNoContrato) {
                    if ($rowEscola->cd_Escola == $cd_escolaNoContrato) {
                        $escolaEstaNoContrato = true;
                    }
                }

                if ($escolaEstaNoContrato) {
                    print "<option value={$rowEscola->cd_Escola} selected>" . $rowEscola->nm_Escola . "</option>";
                } else {
                    print "<option value={$rowEscola->cd_Escola}>" . $rowEscola->nm_Escola . "</option>";
                }
            }
            ?>
        </datalist>
    </select>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>

    </div>
    </div>
   
</section>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
