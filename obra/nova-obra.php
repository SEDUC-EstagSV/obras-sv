<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);

?>

<h1>Nova obra</h1>

<form action="?page=salvarobra" method="POST">
    <input type="hidden" name="acaoobra" value="cadastrarObra">
    <div class="mb-3">
        <label>Número do contrato</label>
        <input type="text" name="cd_Contrato" id="cd_contrato" class="form-control" onkeyup="loadContratos(this.value)" onfocus="fecharContratos()">
        <span id="resultado_pesquisaContrato"></span>
    </div>
    
       
    <div class="mb-3">
        <label>Escola</label>
    <?php
        try {
            $sql = "SELECT * FROM escola";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de fornecedores');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }

        print "<select class='form-select' name='nm_Escola' onchange=pesquisaContratoEscola(this)>";
        print "<datalist>";
        print "<option value='' disabled selected>Selecione o nome da Escola</option>";


        while ($row = $res->fetch_object()) {

            print "<option value={$row->cd_Escola}>" . $row->nm_Escola . "</option>";

        }
        print "</datalist>";
        print "</select>";
        ?>

    </div>


    <div class="mb-3">
        <label>Contrato</label>
    <?php
        print "<select class='form-select contrato' name='cd_Contrato'   disabled>";
        print "<datalist>";
        print "<option value='' disabled selected>Selecione o nº do Contrato</option>";
        print "</select>";
    ?>

    </div>
    
    
    
    
    
    
    
    <div class="mb-3">
        <label>Contratante</label>
        <input type="nome" name="nm_Contratante" class="form-control">
    </div>
    <div class="mb-3">
        <label>Descrição da Atividade</label>
        <input type="text" name="tp_AtivDescricao" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação da Obra</label>
        <input type="text" name="st_Obra" class="form-control">
    </div>
    <div class="mb-3">
        <label>Comentário</label>
        <input type="text" name="tp_Comentario" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>


</form>


<script>
    function pesquisaContratoEscola(selected) {
        console.log(selected);
        $.post('pesquisaContratoPorEscola.php', {'pesquisa' : selected.value}, function(data){
            var jsonData = JSON.parse(data); // turn the data string into JSON
            var newHtml = ""; // Initialize the var outside of the .each function
            $("select.form-select.contrato").html(jsonData);
            if(data.charAt(16) != '-'){
                $("select.form-select.contrato").removeAttr('disabled');
            } else {
                $("select.form-select.contrato").attr("disabled", "disabled");
            }
        });
    }
</script>
<script type="text/javascript" src="./js/utils.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>