<h1>Lista de Obras</h1>

<?php

require_once 'contrato/function-contrato.php';

try{
    $sql = "SELECT ow.*, ob.st_Obra FROM obraview ow INNER JOIN obra ob ON ow.cd_Obra = ob.cd_Obra"; //view não possuia st_Obra e a falta do INNER JOIN duplicava os resultados
    
    $res = $conn->query($sql);
    
    $qtd = $res->num_rows;
} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados de obras');
                    window.history.go(-1);</script>";
}

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

    if(liberaFuncaoParaAutoridade(3))
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
        
        if(liberaFuncaoParaAutoridade(3))
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
