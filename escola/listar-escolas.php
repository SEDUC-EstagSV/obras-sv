<?php
    include_once('function-seduc.php');

    confereAutoridade();
?>

<h1>Lista de Escolas</h1>


<?php
$sql = "SELECT * FROM escola";

$res = $conn->query($sql);

$qtd = $res->num_rows;

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
        print "<td>" . $row->st_Escola . "</td>";
        print "<td>

                <button onclick=\"location.href='?page=editarescola&cd_Escola=" . $row->cd_Escola . "';\" class='btn btn-success'>Editar</button>
                <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarescola&acaoescola=excluirEscola&cd_Escola=" . $row->cd_Escola . "';}else{false;}\" class='btn btn-danger'>Excluir</button>

            </td>";
        print "</tr>";
    }
    print "</table>";
} else
    print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";
