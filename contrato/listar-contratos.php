<h1>Lista de Contratos</h1>

<?php

require_once 'function-contrato.php';

$sql = "SELECT * FROM contratoview";

$res = $conn->query($sql);

$qtd = $res->num_rows;



if ($qtd > 0) {
    print "<table class='table table-hover table-striped table-bordered'>";
    print "<tr>";
    print "<th>#Contrato</th>";
    print "<th>#Fornecedor</th>";
    print "<th>Nome do Fornecedor</th>";
    print "<th>Ano do Contrato</th>";
    print "<th>Inínio</th>";
    print "<th>Termino</th>";
    print "<th>Prazo Contratual</th>";
    print "<th>Tempo decorrido</th>";
    print "<th>Prazo a vencer</th>";
    print "<th>Objeto do Contrato</th>";
    print "<th>Situação do Contrato</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->cd_Contrato . "</td>";
        print "<td>" . $row->cd_Fornecedor . "</td>";
        print "<td>" . $row->nm_Fornecedor . "</td>";
        print "<td>" . $row->dt_AnoContrato . "</td>";
        print "<td>" . $row->dt_Inicial . "</td>";
        print "<td>" . $row->dt_Final . "</td>";
        print "<td>" . $row->pr_Total . "</td>";
        $dt_Inicial = $row->dt_Inicial;
        $dt_Final = $row->dt_Final;
        print "<td>" . dataDecorrida($dt_Inicial, $dt_Final) . "</td>";
        print "<td>" . dataVencer($dt_Final) . "</td>";
        print "<td>" . $row->tp_Servico . "</td>";
        print "<td>" . $row->st_Contrato . "</td>";
        print "<td>

                    <button onclick=\"location.href='?page=editarcontrato&cd_Contrato=" . $row->cd_Contrato . "';\" class='btn btn-success'>Editar</button>
                    <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarcontrato&acaocontrato=excluircontrato&cd_Contrato=" . $row->cd_Contrato . "';}else{false;}\" class='btn btn-danger'>Excluir</button>

            </td>";
        print "</tr>";
    }
    print "</table>";
} else
    print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";
