<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>


<section id="servicos" class="caixa">
      <div class="container">
      <div class="container-fluid" >
      <div class="secao-title">

<h3>Lista de Usuários</h3>

</div>
        <div class="card border-dark mb-3">

          <div class="card-body text-dark">
    <div class="container"> 


<?php
require_once('function-seduc.php');

try{
    $sql = "SELECT u.*, f.nm_Fornecedor, na.cd_nivelAutoridade, na.nm_nivelAutoridade FROM usuario u 
                LEFT JOIN fornecedor f 
                ON u.cd_Fornecedor = f.cd_Fornecedor
                INNER JOIN nivel_autoridade na
                ON u.cd_nivelAutoridade = na.cd_nivelAutoridade";
    
    $res = $conn->query($sql);
    
    $qtd = $res->num_rows;

} catch (mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados dos usuários');
                    location.href='painel.php';</script>";
    criaLogErro($e);
}


if ($qtd > 0) {
    print "<table class='table table-hover table-striped table-bordered'>";
    print "<tr>";
    print "<th>#Usuário</th>";
    print "<th>Fornecedor</th>";
    print "<th>User</th>";
    print "<th>Nome</th>";
    print "<th>E-mail</th>";
    print "<th>Telefone</th>";
    print "<th>Nivel de permissão</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {

        print "<tr>";
        print "<td>" . $row->cd_Usuario . "</td>";
        print "<td>" . $row->nm_Fornecedor . "</td>";
        print "<td>" . $row->user_Login . "</td>";
        print "<td>" . $row->user_Nome . "</td>";
        print "<td>" . $row->user_Email . "</td>";
        print "<td>" . $row->user_Telefone . "</td>";
        print "<td>" . $row->nm_nivelAutoridade . "</td>";
        print "<td>";
        
        if($_SESSION['user'][1] > $row->cd_nivelAutoridade || $_SESSION['user'][1] == 10){
            print "<button onclick=\"location.href='?page=gerenciarusuario&cd_Usuario=$row->cd_Usuario';\" class='btn btn-success'>Editar</button>
             <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarusuario&acaousuario=excluirusuario&cd_Usuario=" . $row->cd_Usuario . "';}else{false;}\" class='btn btn-danger'>Excluir</button>";
        }
        print "</td>";
        print "</tr>";
    }
    print "</table>";
} else
    print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";

    ?>

    </div>
    </div>
    </div>    
    </div>
    </div>    
    </div>
</section>
