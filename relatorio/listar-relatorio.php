<h1>Lista de relatórios</h1>
<?php

require_once('function-seduc.php');
redirecionamentoPorAutoridade(3);
try{
    $sql = "SELECT * FROM relatorioview";
    
    $res = $conn->query($sql);
    
    $qtd = $res->num_rows;
} catch(mysqli_sql_exception $e){
    /*
    print "<script>alert('Ocorreu um erro interno ao buscar dados dos relatórios');
                    location.href='painel.php';</script>";
    */
    criaLogErro($e);
}

if ($qtd > 0) {
    print "<table class='table table-hover table-striped table-bordered'>";
    print "<tr>";
    print "<th>#Relatório</th>";
    print "<th>Número do Relatório</th>";
    print "<th>#Obra</th>";
    print "<th>Nome da obra</th>";
    print "<th>#Escola</th>";
    print "<th>Nome da Escola</th>";
    print "<th>Local</th>";
    print "<th>N° do Contrato</th>";
    print "<th>Fornecedor</th>";
    print "<th>Nome do Contratante</th>";
    print "<th>Atividade Realizada</th>";
    print "<th>Inínio do contrato</th>";
    print "<th>Termino do Contrato</th>";
    print "<th>Tempo decorrido</th>";
    print "<th>Prazo restante</th>";
    print "<th>Técnico Responsável</th>";
    print "<th>Email do Responsável</th>";
    print "<th>Responsável pelo local</th>";
    print "<th>Situação do Relatório</th>";
    print "<th>Período do dia</th>";
    print "<th>Clima</th>";
    print "<th>Condição para trabalhar</th>";
    print "<th>Total Mão de Obra</th>";
    print "<th>Ajudantes</th>";
    print "<th>Eletricistas</th>";
    print "<th>Mestres de Obra</th>";
    print "<th>Pedreiros</th>";
    print "<th>Serventes</th>";
    print "<th>Mão Direta</th>";
    print "<th>Porcentagem concluída</th>";
    print "<th>Situação da Obra</th>";
    print "<th>Comentário</th>";
    print "<th>Data do Carimbo</th>";
    print "<th>Dia da semana</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->cd_Relatorio . "</td>";
        print "<td>" . $row->num_Relatorio . "</td>";
        print "<td>" . $row->cd_Obra . "</td>";
        print "<td>" . $row->tp_AtivRealizada . "</td>";
        print "<td>" . $row->cd_Escola . "</td>";
        print "<td>" . $row->nm_Escola . "</td>";
        print "<td>" . $row->ds_Local . "</td>";
        print "<td>" . $row->cd_Contrato . "</td>";
        print "<td>" . $row->nm_Fornecedor . "</td>";
        print "<td>" . $row->nm_Contratante . "</td>";
        print "<td>" . $row->tp_AtivRealizada . "</td>";
        print "<td>" . $row->dt_Inicial . "</td>";
        print "<td>" . $row->dt_Final . "</td>";
        print "<td>" . $row->pr_Decorrido . "</td>";
        print "<td>" . $row->pr_Vencer . "</td>";
        print "<td>" . $row->nm_TecResponsavel . "</td>";
        print "<td>" . $row->ds_Email_TecResponsavel . "</td>";
        print "<td>" . $row->nm_LocResponsavel . "</td>";
        //$tp_RelaSituacao = formatarRelatorioSit($row->tp_RelaSituacao);
        print "<td>" . $row->nm_situacaoRelatorio . "</td>";
        print "<td>" . $row->Periodo . "</td>";
        print "<td>" . $row->nm_tipoTempo . "</td>";
        print "<td>" . $row->nm_tipoCondicao . "</td>";
        print "<td>" . $row->qt_totalMaoDeObra . "</td>";
        print "<td>" . $row->qt_Ajudantes . "</td>";
        print "<td>" . $row->qt_Eletricistas . "</td>";
        print "<td>" . $row->qt_Mestres . "</td>";
        print "<td>" . $row->qt_Pedreiros . "</td>";
        print "<td>" . $row->qt_Serventes . "</td>";
        print "<td>" . $row->qt_MaoDireta . "</td>";
        print "<td>" . $row->pt_Conclusao . "</td>";
        print "<td>" . $row->nm_situacaoObra . "</td>";
        print "<td>" . $row->tp_Comentario . "</td>";
        print "<td>" . $row->dt_Carimbo . "</td>";
        print "<td>" . $row->nm_Dia . "</td>";
        print "<td>

                    <button onclick=\"location.href='?page=editarrelatorio&cd_Relatorio=" . $row->cd_Relatorio . "';\" class='btn btn-success mb-3'>Editar</button>
                    <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarrelatorio&acaorelatorio=excluirRelatorio&cd_Relatorio=" . $row->cd_Relatorio . "';}else{false;}\" class='btn btn-danger mb-3'>Excluir</button>
                    <button class='btn btn-warning mb-3'>Imprimir</button>

            </td>";
        print "</tr>";
    }
    print "</table>";
} else
    print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";
