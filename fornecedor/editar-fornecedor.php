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
<h3>Editar fornecedor</h3>
      </div>
<?php
$cd_Fornecedor = $_REQUEST["cd_Fornecedor"];
try{
    $sql = $conn->prepare("SELECT * FROM fornecedor WHERE cd_Fornecedor = ?");
    $sql->bind_param('i', $cd_Fornecedor);
    $sql->execute();

    $res = $sql->get_result();
    $row = $res->fetch_object();
} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados do fornecedor');
                    window.history.go(-1);</script>";
    criaLogErro($e);
}

?>

<form action="?page=salvarfornecedor" method="POST">
    <input type="hidden" name="acaofornecedor" value="editarfornecedor">
    <input type="hidden" name="cd_Fornecedor" value="<?php print $row->cd_Fornecedor; ?>">
    <div class="mb-3">
        <label>Nome fornecedor</label>
        <input type="nome" name="nm_Fornecedor" value="<?php print $row->nm_Fornecedor; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="ds_Email" value="<?php print $row->ds_Email; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Endereço</label>
        <input type="text" name="ds_Endereco" value="<?php print $row->ds_Endereco; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>CNPJ</label>
        <input type="text" name="num_CNPJ" value="<?php print $row->num_CNPJ; ?>" class="form-control">
    </div>
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>

</section>
