<?php

require_once('function-seduc.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Relatório (RDO)</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="sv.ico">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="https://allfont.ru/allfont.css?fonts=english-111-vivace-bt" rel="stylesheet">

  <style>
    h1 {
      font-family: 'English 111 Vivace BT', arial;
    }

    #page-break {
      page-break-before: always;
      widows: 3;
      orphans: 3;
    }
  </style>
</head>

<body>


  <header>
    <div class='container-fluid'>
      <div class='container mt-3 text-center'>
        <h1> <img src='img/padrao.png' width='90' height='90'>
          Prefeitura Municipal de São Vicente</h1>
      </div>
      <div class='container text-center'>
        <h5>Cidade Monumento da História Pátria</h5>
        <h5>Cellula Mater da Nacionalidade</h5>
      </div>


  </header>

  </div>


  <main>



    <?php
    //$cd_Relatorio = $_REQUEST["cd_Relatorio"];
    $cd_Relatorio = 21;


    try {
      $sql = $conn->prepare("SELECT * FROM relatorioview WHERE cd_Relatorio = $cd_Relatorio");
      //$sql->bind_param('i', $cd_Relatorio);
      $sql->execute();
      $res = $sql->get_result();

      $rowRelatorio = $res->fetch_object();
    } catch (mysqli_sql_exception $e) {
      print "<script>alert('Ocorreu um erro interno ao buscar dados do relatório');
                    window.history.go(-1);</script>";
      criaLogErro($e);
    }

    echo '<div class="container mt-3 text-center">
<div class="row border border-dark border-1 mb-3">
  <div class="col bg-secondary bg-opacity-50" style="font-weight: bold">Relatório Diário de Obra (RDO)
  </div>
</div>';

    echo '<div class="row mb-3">

  <div id="fst" class="col-3 border border-dark border-1 bg-warning">Pendente</div>
  <div class="col-4"></div>

  <div class="col-3  border border-dark border-1 bg-secondary bg-opacity-50" style="font-weight: bold">
    Relatório</div>';
    echo '<div class="col-2 border border-start-0 border-dark border-1">nº ';
    echo $row->num_Relatorio;
    echo '</div>
</div>';

    echo '<div class="row">
  <div class="col border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-50"
    style="font-weight: bold">Informações do Relatório</div>
</div>';

    echo '<div class="row">
  <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">Responsável
    Técnico</div>';
    echo '<div class="col-9 border border-start-0 border-bottom-0 border-dark border-1">';
    echo $row->nm_TecResponsavel;
    echo '</div>
</div>';


    echo '<div class="row">
  <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">E-mail</div>';
    echo '<div class="col-9 border border-start-0 border-dark border-1">';
    echo $row->ds_Email_TecResponsavel;
    echo '</div>
</div>';

    echo '<div class="row">
  <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">Contratante
  </div>
  <div class="col-9 border border-start-0 border-top-0 border-dark border-1">x</div>
</div>';

    echo '<div class="row">
  <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">Obra-Local
  </div>';
    echo '<div class="col-9 border border-start-0 border-top-0 border-dark border-1">';
    echo $row->nm_Escola . " - " . $row->ds_Local;
    echo '</div>
</div>';



    echo '<div class="row">
  <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">Prazo Contratual</div>
  <div class="col-4 border border-start-0 border-top-0 border-dark border-1">';
    echo $row->pr_Total;
    echo '</div>
  <div class="col-3 border border-start-0 border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
    Contrato</div>
  <div class="col-2 border border-start-0 border-top-0 border-dark border-1">';
    echo 'nº ' . $row->cd_Contrato;
    echo '</div>
</div>';

    echo '<div class="row">
  <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">Prazo
    Decorrido</div>
  <div class="col-4 border border-start-0 border-top-0 border-dark border-1">';
    echo $row->pr_Decorrido;
    echo '</div>
  <div class="col-3 border border-start-0 border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
    Data do
    Relatório
  </div>
  <div class="col-2 border border-start-0 border-top-0 border-dark border-1">';



    //***Variável abaixo para receber valor da data e hora do Relatório***
    $dataParaMudar = $row->dt_Carimbo;

    //***Variável abaixo para receber o valor e alterar para formatação brasileira***
    $dataFormatada = DateTime::createFromFormat("Y-m-d H:i:s", $dataParaMudar);


    //***Retorna a data formatada PT-BR  ***
    echo $dataFormatada->format("d/m/Y");

    echo '</div>
</div>';

    echo '<div class="row">
  <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">Prazo a Vencer
  </div>
  <div class="col-4 border border-start-0 border-top-0 border-dark border-1">';
    echo $row->pr_Vencer;
    echo '</div>';
    echo '<div class="col-3 border border-start-0 border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
    Dia da Semana
  </div>';
    echo '<div class="col-2 border border-start-0 border-top-0 border-dark border-1">';
    //Variável que recebe o valor correspondente ao dia da semana em inglês
    //$dataFormatadaNova = DateTime::createFromFormat("w", $dataParaMudar);

    //Valor do dia da semana em inglês
    $diaSemana = date("l", strtotime($dataParaMudar));

    //$diaSemana = $dayofweek; //Valor do dia da semana em inglês
    $allweekdays = array("Sunday" => "Domingo", "Monday" => "Segunda-feira", "Tuesday" => "Terça-feira", "Wednesday" => "Quarta-feira", "Thursday" => "Quinta-feira", "Friday" => "Sexta-feira", "Saturday" => "Sábado");
    echo $allweekdays[$diaSemana];

    echo '</div>
</div>';

    echo '<div class="row mb-3">
  <div class="col-3 border border-dark border-1 bg-secondary bg-opacity-25">Responsável no
    Local</div>';
    echo '<div class="col-9 border border-start-0 border-top-0 border-dark border-1">';
    echo $row->nm_LocResponsavel;
    echo '</div>
</div>';


    // *** INFORMAÇÕES DA OBRA ***

    echo '<div class="row">
  <div class="col border border-dark border-1 bg-secondary bg-opacity-50" style="font-weight: bold">
    Informações da Obra</div>
</div>';

    echo '<div class="row">
  <div class="col-3 border border-top-0 border-dark border-1 bg-secondary bg-opacity-25">Situação da Obra
  </div>';
    echo '<div class="col-4 border border-start-0 border-top-0 border-dark border-1">';
    echo $row->nm_situacaost_Obra;
    echo '</div>';
    echo '<div class="col-3 border border-start-0 border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
    Conclusão</div>';
    echo '<div class="col-2 border border-start-0 border-top-0 border-dark border-1">';
    echo $row->pt_Conclusao . "%";
    echo '</div>
</div>';

    echo '<div class="row">
  <div class="col-3 border border-top-0 border-dark border-1 bg-secondary bg-opacity-25">Condição</div>';
    echo '<div class="col-4 border border-start-0 border-top-0 border-dark border-1">';
    echo $row->nm_tipoCondicao;
    echo '</div>';
    echo '<div class="col-3 border border-start-0 border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
    Período</div>';
    echo '<div class="col-2 border border-start-0 border-top-0 border-dark border-1">';
    echo $row->Periodo;
    echo '</div>
</div>';

    echo '<div class="row">
  <div class="col-3 border border-top-0 border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
    Tempo</div>';
    echo '<div class="col-4 border border-start-0 border-top-0 border-bottom-0 border-dark border-1">';
    echo $row->nm_tipoTempo;
    echo '</div>
  <div
    class="col-3 border border-start-0 border-top-0 border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
    Total de Mão de Obra
  </div>';
    echo '<div class="col-2 border border-start-0 border-top-0 border-bottom-0 border-dark border-1">';
    echo $row->qt_TotalMaodeObra;
    echo '</div>
</div>';



    echo '<div class="row">
  <div class="col-2 border border-end-0 border-dark border-1 bg-secondary bg-opacity-25">Ajudante</div>
  <div class="col-2 border border-end-0 border-dark border-1 bg-secondary bg-opacity-25">Eletricista</div>
  <div class="col-2 border border-end-0 border-dark border-1 bg-secondary bg-opacity-25">Pedreiro</div>
  <div class="col-2 border border-end-0 border-dark border-1 bg-secondary bg-opacity-25">Servente</div>
  <div class="col-2 border border-end-0 border-dark border-1 bg-secondary bg-opacity-25">Mão de Obra
    Direta</div>
  <div class="col-2 border border-dark border-1 bg-secondary bg-opacity-25">Mestre de Obra</div>
</div>';

    echo '<div class="row mb-3">
  <div class="col-2 border border-top-0 border-dark border-1">';
    echo $row->qt_Ajudantes;
    echo '</div>';
    echo '<div class="col-2 border border-top-0 border-start-0 border-dark border-1">';
    echo $row->qt_Eletricistas;
    echo '</div>';
    echo '<div class="col-2 border border-top-0 border-start-0 border-dark border-1">';
    echo $row->qt_Pedreiros;
    echo '</div>';
    echo '<div class="col-2 border border-top-0 border-start-0 border-dark border-1">';
    echo $row->qt_Serventes;
    echo '</div>';
    echo '<div class="col-2 border border-top-0 border-start-0 border-dark border-1">';
    echo $row->qt_MaoDireta;
    echo '</div>';
    echo '<div class="col-2 border border-top-0 border-start-0 border-dark border-1">';
    echo $row->qt_Mestres;
    echo '</div>
</div>';

    echo '<div class="row">
  <div class="col border border-dark border-1 bg-secondary bg-opacity-50" style="font-weight: bold">
    Descrição de Atividade realizada
  </div>
</div>';

    echo '<div class="row mb-3">';
    echo '<div class="col border border-top-0 border-dark border-1">';
    echo $row->tp_AtivRealizada;
    echo '</div>
</div>';





    echo '<div class="row">
  <div class="col border border-dark border-1 bg-secondary bg-opacity-50" style="font-weight: bold">
    Comentários</div>
</div>';

    echo '<div class="row mb-3">';
    echo '<div class="col border border-top-0 border-dark border-1">';
    //echo $row->tp_RelaComentario;
    echo '</div>
</div>';



    ?>


    <div class="row">
      <div class="col mb-3">__________________________________________________</div>
    </div>

    <div class="row">
      <div class="col">Responsável Técnico</div>
    </div>

    </div>


  </main>




</body>

</html>