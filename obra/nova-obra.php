<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);

?>

<h1>Nova obra</h1>

<form action="?page=salvarobra" method="POST">
    <input type="hidden" name="acaoobra" value="cadastrarObra">
    <div class="mb-3">
        <label>Número do contrato</label>
        <input type="text" name="num_contrato" id="num_contrato" class="form-control" 
                placeholder="Digite o nº do contrato e ano - ex.: 3/2023" 
                onkeyup="loadContratos(this.value)" 
                onfocus="fecharContratos()"
                autocomplete="off">
        <span id="resultado_pesquisaContrato"></span>
    </div>
    
       
    <div class="mb-3">
        <label>Escola</label>
    
        <select class='form-select escola' name='nm_Escola' disabled>
        <datalist>
        <option value='' disabled selected>Selecione um contrato para ver a lista de escolas</option>  
        </datalist>
        </select>
        
    </div>

    <div class="mb-3">
        <label>Descrição da Atividade</label>
        <input type="text" name="tp_AtivDescricao" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação da Obra</label>
        <?php
    
        try {
            $sql = "SELECT * FROM situacao_obra";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de situacao de obra');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }
    
        print "<select class='form-select obra' name='st_Obra' >";
        print "<datalist>";
        print "<option value='' disabled selected>Selecione a situação da obra</option>";

    
        while ($row = $res->fetch_object()) {

            print "<option value={$row->cd_situacaoObra}>" . $row->nm_situacaoObra . "</option>";

        }
    
        print "</datalist>";
        print "</select>";
        ?>
    </div>
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>


</form>


<script>


</script>
<script type="text/javascript" src="./js/utils.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>