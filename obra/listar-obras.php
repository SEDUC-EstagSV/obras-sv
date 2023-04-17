<style>
  #keepAll {
	word-break: keep-all;
  }


  #grid-table>div.row {
    color: black;
    justify-content: center;
  }

  .btn {
    font-size: 15px;
    margin: 1px;
    margin-top: 2px;
    margin-bottom: 5px;
    padding: 3px;
    width: 60px;
  }

  .caixa {
    font-size: 16px;
    margin-left: 50px;
    margin-right: 80px;
    padding-right: 10px;
    padding-left: 10px;
    margin: 10px;
    margin-bottom: 100px;
  }


  .form-control {
    width: 100%;
    border-radius: 5px;
  }

  #servicos {
    padding: 25px;
  }


  @media (min-width: 992px) {

    .caixa {
      padding-top: 80px;
    }
  }

  @media (max-width: 575.98px) {
    .caixa {
      margin: 16px;
      margin-left: -55px;
      margin-right: -65px;
      font-size: 9px;
      background-color: white;
      padding: 25px 8px 20px 10px;
    }

    .btn {
      font-size: 9px;
      margin: 3px;
      padding: 5px;
      width: 40px;
    }

    div.col {
      margin: auto;
      width: 100%;
      word-break: break-word;
      padding: 10 0 10 0;
      padding: 2px;
    }

    #servicos {
      padding: 10px 5px 2px 1px;
    }

  }
</style>

<div id="servicos" class="caixa">

  <h3>Lista de Obras</h3>
	<div style="overflow-x:auto;">

  <?php

  require_once 'contrato/function-contrato.php';
  redirecionamentoPorAutoridade(3);

  try {
    $sql = "SELECT * FROM obraview";

    $res = $conn->query($sql);

    $qtd = $res->num_rows;
  } catch (mysqli_sql_exception $e) {

    print "<script>alert('Ocorreu um erro interno ao buscar dados de obras');
                    location.href='painel.php';</script>";

    criaLogErro($e);
  }

  if ($qtd > 0) {


    //print '<div id="grid-table" class="container mt-3 table bg-dark text-light table-striped">';

    // print '<div class="row">';


    print "<table class='table table-hover table-striped table-bordered'>";
    print "<tr>";
    print "<th id='keepAll' class='align-middle text-center'>#Obra</th>";
    //  print "<th>Nome da Obra</th>";
    print "<th id='keepAll' class='align-middle text-center'>Escola</th>";
    //  print "<th>Endereço</th>";
    print "<th id='keepAll' class='align-middle text-center'>N° do Contrato</th>";
    // print "<th>Ano do Contrato</th>";
    print "<th id='keepAll' class='align-middle text-center'>Fornecedor</th>";
    //print "<th>Início do Contrato</th>";
    // print "<th>Termino do Contrato</th>";
    //print "<th>Prazo Contratual</th>";
    //print "<th>Tempo decorrido</th>";
    // print "<th>Prazo a vencer</th>";
    print "<th id='keepAll' class='align-middle text-center'>Situação da Obra</th>";
    // print "<th>Descrição da Atividade</th>";
    //print "<th>Comentários</th>";

    if (liberaFuncaoParaAutoridade(4)) {
      print "<th class='align-middle text-center'>Ações</th>";
    }

    print "</tr>";
    while ($row = $res->fetch_object()) {
      print "<tr>";
      print "<td class='align-middle text-center'>" . $row->cd_Obra . "</td>";
      //   print "<td>" . $row->tp_Servico . "</td>";
      print "<td id='keepAll' class='align-middle'>" . $row->nm_Escola . "</td>";
      //   print "<td>" . $row->ds_Local . "</td>";
      print "<td id='keepAll' class='align-middle text-center'>" . $row->num_contrato . "</td>";
      //print "<td>" . $row->dt_AnoContrato . "</td>";
      print "<td id='keepAll' class='align-middle'>" . $row->nm_Fornecedor . "</td>";
      //  print "<td>" . $row->dt_Inicial . "</td>";
      //  print "<td>" . $row->dt_Final . "</td>";
      //   print "<td>" . $row->pr_Total . "</td>";
      $dt_Inicial = $row->dt_Inicial;
      $dt_Final = $row->dt_Final;
      //  print "<td>" . dataDecorrida($dt_Inicial, $dt_Final) . "</td>";
      //  print "<td>" . dataVencer($dt_Final) . "</td>";
      print "<td id='keepAll' class='align-middle text-center'>" . $row->nm_situacaoObra . "</td>";
      //   print "<td>" . $row->tp_AtividadeDescricao . "</td>";
      //print "<td>" . $row->tp_Comentario . "</td>";

      if (liberaFuncaoParaAutoridade(4)) {
        print "<td class='align-middle text-center'>

            <button onclick=\"location.href='?page=editarobra&cd_Obra=" . $row->cd_Obra . "';\" class='btn btn-success'>Editar</button>
            <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarobra&acaoobra=excluirObra&cd_Obra=" . $row->cd_Obra . "';}else{false;}\" class='btn btn-danger'>Excluir</button>

    </td>";
      }


      print "</tr>";
    }
    print "</table>";
	
	print "</div>";
  } else
    print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";

  ?>

</div>