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
<h3>Editar usuário</h3>
      </div>

<?php
require_once('function-seduc.php');
$cd_Usuario = $_REQUEST["cd_Usuario"];

try{
    $sql = $conn->prepare("SELECT * FROM usuario WHERE cd_Usuario = ?");
    $sql->bind_param('i', $cd_Usuario);
    $sql->execute();
    
    $res = $sql->get_result();
    $row = $res->fetch_object();

} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados do usuário');
                    window.history.go(-1);</script>";
    criaLogErro($e);
}
?>

<form action="?page=salvarusuario" method="POST">
    <input type="hidden" name="acaousuario" value="editarusuario">
    <input type="hidden" name="cd_Usuario" value="<?php print $row->cd_Usuario; ?>">
    <div class="mb-3">
        <label>Nome de Usuario</label>
        <input type="nome" name="user_Login" value="<?php print $row->user_Login; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Senha atual</label>
        <input type="password" name="user_SenhaAntiga" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nova Senha</label>
        <input type="password" name="user_Senha" class="form-control">
    </div>
    <div class="mb-3">
        <label>Confirmar Senha</label>
        <input type="password" name="user_Senha2" class="form-control">
    </div>
    <div class="mb-3">
        <label>Seu nome</label>
        <input type="nome" name="user_Nome" value="<?php print $row->user_Nome; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>E-mail</label>
        <input type="text" name="user_Email" value="<?php print $row->user_Email; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" name="user_Telefone" value="<?php print $row->user_Telefone; ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Permissão de usuário</label>
        <?php
        try {
            $sql = "SELECT * FROM nivel_autoridade";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de usuário');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }

        print "<select class='form-select' name='user_Autoridade'>";
        print "<datalist>";
        print "<option value=$row->cd_nivelAutoridade readonly selected>$row->nm_nivelAutoridade</option>";


        while ($rowAutoridade = $res->fetch_object()) {

            print "<option value=$rowAutoridade->cd_nivelAutoridade>" . $rowAutoridade->nm_nivelAutoridade . "</option>";

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
