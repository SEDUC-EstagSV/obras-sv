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
      <div class="secao-title">
<h3>Editar escola</h3>
      </div>
<?php
$cd_Escola = $_REQUEST["cd_Escola"];

try {
    $sql = $conn->prepare("SELECT * FROM escolaview WHERE cd_Escola = ?");
    $sql->bind_param('i', $cd_Escola);
    $sql->execute();

    $res = $sql->get_result();
    $row = $res->fetch_object();
} catch (mysqli_sql_exception $e) {
    print "<script>alert('Ocorreu um erro interno ao buscar dados da escola');
                        window.history.go(-1);</script>";
    criaLogErro($e);
}
?>

<form action="?page=salvarescola" method="POST">
    <input type="hidden" name="acaoescola" value="editarescola">
    <input type="hidden" name="cd_Escola" value="<?php print $row->cd_Escola; ?>">
    <div class="mb-3">
        <label>Nome da Escola</label>
        <input type="nome" name="nm_Escola" value="<?php print $row->nm_Escola; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Endereço</label>
        <input type="text" name="ds_Local" value="<?php print $row->ds_Local; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação</label>

        <?php
        try {
            $sql = "SELECT * FROM status_escola";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de usuário');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }

        print "<select class='form-select' name='st_Escola'>";
        print "<datalist>";
        print "<option value=$row->cd_statusEscola readonly hidden selected>$row->nm_statusEscola</option>";


        while ($rowEscola = $res->fetch_object()) {

            print "<option value=$rowEscola->cd_statusEscola>" . $rowEscola->nm_statusEscola . "</option>";

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