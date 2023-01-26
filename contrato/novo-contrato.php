<?php
include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);
?>


<h1>Novo Contrato</h1>

<form action="?page=salvarcontrato" method="POST">
    <input type="hidden" name="acaocontrato" value="CadastrarContrato">
    <div class="mb-3">
        <label>Número do Contrato</label>
        <input type="text" name="num_contrato" class="form-control">
    </div>
    <div class="mb-3">
        <label>Fornecedor</label>

        <?php
        try {
            $sql = "SELECT * FROM fornecedor WHERE cd_Fornecedor <> -1";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de fornecedores');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }

        print "<select class='form-select' name='cd_Fornecedor'>";
        print "<datalist>";
        print "<option value='' disabled selected>Selecione o fornecedor</option>";


        while ($row = $res->fetch_object()) {

            print "<option value=$row->cd_Fornecedor>" . $row->nm_Fornecedor . "</option>";

        }
        print "</datalist>";
        print "</select>";
        ?>


    </div>
    <div class="mb-3">
        <label>Ano do Contrato</label>
        <input type="text" placeholder="Ex.: 2020" maxlength="4" pattern="\d{4}" name="dt_AnoContrato" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Situação do Contrato</label>
        <?php
        try {
            $sql = "SELECT * FROM situacao_contrato";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de fornecedores');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }

        print "<select class='form-select' name='st_Contrato'>";
        print "<datalist>";
        print "<option value='' disabled selected>Selecione a situação do contrato</option>";


        while ($row = $res->fetch_object()) {

            print "<option value={$row->cd_situacao}>" . $row->nm_situacao . "</option>";

        }
        print "</datalist>";
        print "</select>";
        ?>
    
    </div>
    <div class="mb-3">
        <label>Serviço</label>
        <input type="text" name="tp_Servico" class="form-control" placeholder="(Objeto do contrato)">
    </div>
    <div class="mb-3">
        <label>Data inicial do Contrato</label>
        <input type="date" name="dt_Inicial" class="form-control">
    </div>
    <div class="mb-3">
        <label>Data de conclusão do Contrato</label>
        <input type="date" name="dt_Final" class="form-control">
    </div>


    <div style="display: flex; flex-direction: column;">
        <label>Selecione as escolas incluídas no contrato</label>
            <select class="selectpicker mb-3" id="select" name="escolas[]" 
            multiple data-live-search="true" title="Selecione escolas vinculadas a este contrato"
            data-selected-text-format="count" data-width="auto"
            data-count-selected-text="Escolas selecionadas: {0}"
            >
            <datalist>
                <?php
                    try{
                        $sql = "SELECT * FROM escola";
                        
                        $res = $conn->query($sql);
                    } catch(mysqli_sql_exception $e){
                        print "<script>alert('Ocorreu um erro interno ao buscar dados de escolas');
                        location.href='painel.php';</script>";
                        criaLogErro($e);
                    }
                    
                    while ($row = $res->fetch_object()) {
                        
                        print "<option value={$row->cd_Escola}>" . $row->nm_Escola . "</option>";
                        
                    }
                    ?>
            </datalist>
        </select>
    </div>
    
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript"></script>