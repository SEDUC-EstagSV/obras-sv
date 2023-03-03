<style>
 
#grid-table>div.row{
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
    background-color: white;
    font-size: 10px;
    padding: 10px;
}

#space{
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
   padding-left:8px;
   padding-right: 25px;


}


}

</style>


<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);

?>

<section id="servicos" class="caixa">

<div class="secao-title">
<h3>Nova obra</h3>
</div>

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

</section>