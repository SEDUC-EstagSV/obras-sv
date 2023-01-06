<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Lista de Usuários</h1>


<?php
require_once('function-seduc.php');

$sql = "SELECT * FROM usuario";

$res = $conn->query($sql);

$qtd = $res->num_rows;


if ($qtd > 0) {
    print "<table class='table table-hover table-striped table-bordered'>";
    print "<tr>";
    print "<th>#Usuário</th>";
    print "<th>User</th>";
    print "<th>Nome</th>";
    print "<th>E-mail</th>";
    print "<th>Telefone</th>";
    print "<th>Nivel de permissão</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {

        $user_Autoridade = formatarAutoridade($row->user_Autoridade);

        print "<tr>";
        print "<td>" . $row->cd_Usuario . "</td>";
        print "<td>" . $row->user_Login . "</td>";
        print "<td>" . $row->user_Nome . "</td>";
        print "<td>" . $row->user_Email . "</td>";
        print "<td>" . $row->user_Telefone . "</td>";
        print "<td>" . $user_Autoridade . "</td>";
        print "<td>

                    <button onclick=\"location.href='?page=gerenciarusuario&cd_Usuario=" . $row->cd_Usuario . "';\" class='btn btn-success'>Editar</button>
                    <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarusuario&acaousuario=excluirusuario&cd_Usuario=" . $row->cd_Usuario . "';}else{false;}\" class='btn btn-danger'>Excluir</button>

            </td>";
        print "</tr>";
    }
    print "</table>";
} else
    print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";
