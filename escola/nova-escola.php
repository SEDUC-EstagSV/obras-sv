<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Nova Escola</h1>

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