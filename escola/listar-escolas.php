<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Lista de Escolas</h1>


<?php
try{
    $sql = "SELECT e.cd_Escola, e.nm_Escola, e.ds_Local, 
                    ste.cd_statusEscola, ste.nm_statusEscola
            FROM escola e
            INNER JOIN status_escola ste 
            ON e.cd_statusEscola = ste.cd_statusEscola;";
    
    $res = $conn->query($sql);
    
    $qtd = $res->num_rows;
    
} catch (mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados das escolas');
                    location.href='painel.php';</script>";
    criaLogErro($e);
}

if ($qtd > 0) {
    print "<table class='table table-hover table-striped table-bordered'>";
    print "<tr>";
    print "<th>#</th>";
    print "<th>Escola</th>";
    print "<th>Endereço</th>";
    print "<th>Situação</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->cd_Escola . "</td>";
        print "<td>" . $row->nm_Escola . "</td>";
        print "<td>" . $row->ds_Local . "</td>";
        print "<td>" . $row->nm_statusEscola . "</td>";
        print "<td>

                <button onclick=\"location.href='?page=editarescola&cd_Escola=" . $row->cd_Escola . "';\" class='btn btn-success'>Editar</button>
                <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarescola&acaoescola=excluirEscola&cd_Escola=" . $row->cd_Escola . "';}else{false;}\" class='btn btn-danger'>Excluir</button>

            </td>";
        print "</tr>";
    }
    print "</table>";
} else
    print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";
