<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Editar obra</h1>

<?php
$cd_Obra = $_REQUEST["cd_Obra"];

try{
    $sql = $conn->prepare("SELECT o.*, GROUP_CONCAT(ohu.cd_Usuario SEPARATOR ', ') AS cd_Usuarios
                            FROM obraview o 
                            LEFT JOIN obra_has_usuario ohu
                            ON o.cd_Obra = ohu.cd_Obra
                            WHERE o.cd_Obra= ?");
    $sql->bind_param('i', $cd_Obra);
    $sql->execute();
    $res = $sql->get_result();
    
    $row = $res->fetch_object();
} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados da obra');
                    window.history.go(-1);</script>";
    criaLogErro($e);
}
?>

<form action="?page=salvarobra" method="POST">
    <input type="hidden" name="acaoobra" value="editarobra">
    <input type="hidden" name="cd_Obra" value="<?php print $row->cd_Obra; ?>">
    <div class="mb-3">
        <label>Nome da Escola</label>
        <input type="text" name="cd_Escola" value="<?php print $row->nm_Escola; ?>" class="form-control" disabled>
    </div>
    <div class="mb-3">
        <label>N° do Contrato</label>
        <input type="number" name="cd_Contrato" value="<?php print $row->num_contrato; ?>" class="form-control" disabled>
    </div>
    <div class="mb-3">
        <label>Contratante</label>
        <input type="nome" name="nm_Contratante" value="<?php print $row->nm_Contratante; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação da Obra</label>
        <?php
        try {
            $sql = "SELECT * FROM situacao_obra";

            $res = $conn->query($sql);
        } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados de usuário');
                    location.href='painel.php';</script>";
            criaLogErro($e);
        }

        print "<select class='form-select' name='st_Obra'>";
        print "<datalist>";
        print "<option value=$row->cd_situacaoObra readonly hidden selected>$row->nm_situacaoObra</option>";


        while ($rowObra = $res->fetch_object()) {

            print "<option value=$rowObra->cd_situacaoObra>" . $rowObra->nm_situacaoObra . "</option>";

        }
        print "</datalist>";
        print "</select>";
        ?>
    </div>
    <div class="mb-3">
        <label>Descrição da Atividade</label>
        <input type="text" name="tp_AtivDescricao" value="<?php print $row->tp_AtividadeDescricao; ?>" class="form-control">
    </div>

<div class="mb-3">

    <div>Adicionar usuários encarregados dos relatórios da obra</div>
    <select class="selectpicker mb-3" id="select" 
    name="usuarios[]" multiple data-live-search="true" 
    title="Selecione usuários responsáveis" 
    data-selected-text-format="count" data-width="auto"
    data-count-selected-text="Usuários selecionados: {0}">
    <datalist>
            <?php
            try {
                $sql = $conn->prepare("SELECT cd_Usuario, user_Login, user_Nome, user_CPF FROM usuario WHERE cd_nivelAutoridade NOT LIKE ? AND cd_Fornecedor IS NOT NULL;");
                $nivel = 10;
                $sql->bind_param('i', $nivel);
                $sql->execute();
                $res = $sql->get_result();
            } catch (mysqli_sql_exception $e) {
                print "<script>alert('Ocorreu um erro interno ao buscar dados de escolas');
                location.href='painel.php';</script>";
                criaLogErro($e);
            }
            
            $usuariosNaObra = explode(", ", $row->cd_Usuarios);
            while ($rowUsuario = $res->fetch_object()) {
                $usuarioEstaNoContrato = false;
                
                foreach ($usuariosNaObra as $cd_usuarioNoContrato) {
                    if ($rowUsuario->cd_Usuario == $cd_usuarioNoContrato) {
                        $usuarioEstaNoContrato = true;
                    }
                }

                if ($usuarioEstaNoContrato) {
                    print "<option value={$rowUsuario->cd_Usuario} selected>$rowUsuario->user_Nome - $rowUsuario->user_CPF</option>";
                } else {
                    print "<option value={$rowUsuario->cd_Usuario}>$rowUsuario->user_Nome - $rowUsuario->user_CPF</option>";
                }
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