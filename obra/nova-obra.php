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
        <div>Adicionar usuários encarregados dos relatórios da obra</div>


        <select class="selectpicker mb-3" id="select" name="usuarios[]" 
    multiple data-live-search="true" title="Selecione usuários responsáveis"
    data-selected-text-format="count" data-width="auto"
    data-count-selected-text="Usuários selecionados: {0}"
    >
        <datalist>
            <?php
                try{
                    $sql = $conn->prepare("SELECT cd_Usuario, user_Login, user_Nome, user_CPF FROM usuario WHERE cd_nivelAutoridade NOT LIKE ? AND cd_Fornecedor IS NOT NULL;");
                    $nivel = 10;
                    $sql->bind_param('i', $nivel);
                    $sql->execute();
                    $res = $sql->get_result();
                } catch(mysqli_sql_exception $e){
                    print "<script>alert('Ocorreu um erro interno ao buscar dados do formulário');
                        location.href='painel.php';</script>";
                    criaLogErro($e);
                }

                while ($row = $res->fetch_object()) {

                    print "<option value={$row->cd_Usuario}>$row->user_Nome - $row->user_CPF</option>";
        
                }
            ?>
        </datalist>
    </select>

    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>


</form>

<script type="text/javascript" src="./js/utils.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
