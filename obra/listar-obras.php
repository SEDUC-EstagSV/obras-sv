<h1>Lista de Obras</h1>

<?php

require_once 'contrato/function-contrato.php';
$sql = "SELECT ow.*, ob.st_Obra FROM obraview ow, obra ob";

$res = $conn->query($sql);

$qtd = $res->num_rows;


if ($qtd > 0) {
    print "<table class='table table-hover table-striped table-bordered'>";
    print "<tr>";
    print "<th>#Obra</th>";
    print "<th>Nome da Obra</th>";
    print "<th>Nome da Escola</th>";
    print "<th>Endereço</th>";
    print "<th>N° do Contrato</th>";
    print "<th>Fornecedor</th>";
    print "<th>Inínio do Contrato</th>";
    print "<th>Termino do Contrato</th>";
    print "<th>Prazo Contratual</th>";
    print "<th>Tempo decorrido</th>";
    print "<th>Prazo a vencer</th>";
    print "<th>Situação da Obra</th>";
    print "<th>Descrição da Atividade</th>";
    print "<th>Comentários</th>";

    if($_SESSION["user"][1] > 3 && isset($_SESSION["user"][1]))
    {
        print "<th>Ações</th>";
    }


    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->cd_Obra . "</td>";
        print "<td>" . $row->nm_Obra . "</td>";
        print "<td>" . $row->nm_Escola . "</td>";
        print "<td>" . $row->ds_Local . "</td>";
        print "<td>" . $row->cd_Contrato . "</td>";
        print "<td>" . $row->nm_Fornecedor . "</td>";
        print "<td>" . $row->dt_Inicial . "</td>";
        print "<td>" . $row->dt_Final . "</td>";
        print "<td>" . $row->pr_Total . "</td>";
        $dt_Inicial = $row->dt_Inicial;
        $dt_Final = $row->dt_Final;
        print "<td>" . dataDecorrida($dt_Inicial, $dt_Final) . "</td>";
        print "<td>" . dataVencer($dt_Final) . "</td>";
        print "<td>" . $row->st_Obra . "</td>";
        print "<td>" . $row->tp_AtivDescricao . "</td>";
        print "<td>" . $row->tp_Comentario . "</td>";
        
        if($_SESSION["user"][1] > 3 && isset($_SESSION["user"][1]))
          {
            print "<td>

            <button onclick=\"location.href='?page=editarobra&cd_Obra=" . $row->cd_Obra . "';\" class='btn btn-success'>Editar</button>
            <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarobra&acaoobra=excluirObra&cd_Obra=" . $row->cd_Obra . "';}else{false;}\" class='btn btn-danger'>Excluir</button>

    </td>";
          }
        

        print "</tr>";
    }
    print "</table>";
} else
    print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";
