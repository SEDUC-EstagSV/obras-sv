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
    font-size: 15px;
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
<h3>Nova Escola</h3>
</div>

<form action="?page=salvarescola" method="POST">
    <input type="hidden" name="acaoescola" value="cadastrarEscola">
    <div class="mb-3">
        <label>Nome da Escola</label>
        <input type="nome" name="nm_Escola" class="form-control">
    </div>
    <div class="mb-3">
        <label>Endereço da Escola</label>
        <input type="text" name="ds_Local" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação da Escola</label>
        <?php
    
        try {
            $sql = "SELECT * FROM status_escola";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de situacao de obra');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }
    
        print "<select class='form-select escola' name='st_Escola' >";
        print "<datalist>";
        print "<option value='' disabled selected>Selecione a situação da obra</option>";

    
        while ($row = $res->fetch_object()) {

            print "<option value=$row->cd_statusEscola>" . $row->nm_statusEscola . "</option>";

        }
    
        print "</datalist>";
        print "</select>";
        ?>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>
</section>
