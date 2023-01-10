<?php
    include_once('function-seduc.php');

    redirecionamentoPorAutoridade(3);
?>

<h1>Lista de Fornecedores</h1>

<?php
try{
    $sql = "SELECT * FROM fornecedor";
    
    $res = $conn->query($sql);
    
    $qtd = $res->num_rows;
} catch(mysqli_sql_exception $e){
    print "<script>alert('Ocorreu um erro interno ao buscar dados de fornecedores');
                    window.history.go(-1);</script>";
}

if ($qtd > 0) {
    print "<table class='table table-hover table-striped table-bordered'>";
    print "<tr>";
    print "<th>#Fornecedor</th>";
    print "<th>Nome</th>";
    print "<th>Email</th>";
    print "<th>Endereço</th>";
    print "<th>CNPJ</th>";
    print "<th>Situação atual</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->cd_Fornecedor . "</td>";
        print "<td>" . $row->nm_Fornecedor . "</td>";
        print "<td>" . $row->ds_Email . "</td>";
        print "<td>" . $row->ds_Endereco . "</td>";
        print "<td>" . $row->num_CNPJ . "</td>";
        print "<td>" . $row->st_Fornecedor . "</td>";
        print "<td>

                    <button onclick=\"location.href='?page=editarfornecedor&cd_Fornecedor=" . $row->cd_Fornecedor . "';\" class='btn btn-success'>Editar</button>
                    <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarfornecedor&acaofornecedor=excluirFornecedor&cd_Fornecedor=" . $row->cd_Fornecedor . "';}else{false;}\" class='btn btn-danger'>Excluir</button>

            </td>";
        print "</tr>";
    }
    print "</table>";
} else
    print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";
