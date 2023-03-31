<style>
  /* ---------------------------
		Relatório
-----------------------------*/

  #grid-table>div.row {

    color: black;
    justify-content: center;
  }


  /*
.card {
    margin: auto;
    align-items: center;
    flex-direction: column;
    place-items: center;
    justify-content: center;
    
  }

*/
  div.col {
    margin: auto;
    width: 100%;
    /*height: auto;  */
    word-break: break-word;
    padding: 0 0 0 0;
    /*text-align: center;*/
    /*align-items: center;
 justify-content: center;*/
    display: table-cell;
    vertical-align: middle;
  }

  body {
    background: none;
  }

  #tituloImpressao {
    color: black;
    text-shadow: none;

  }

  /*
.btn {
    font-size: 18px;
    margin: 0px;
    margin-right: 10px;

    
    padding: 5px;
    width: 80px;
   }

*/
  /*
.caixa {
  margin: 10px auto;
  font-size: 16px;
  text-align: center;
  margin-bottom: 500px;
}
*/

  #space {
    display: flex;
    justify-content: center;
    width: 100%;
  }


  .caixa {
    display: flex;
    justify-content: center;
    width: 100%;
  }

  @media (max-width: 575.98px) {
    .caixa {
      margin: 15px;
      margin-left: -65px;
      margin-right: -65px;
      font-size: 10px;


    }

    .btn {
      font-size: 10px;
      margin: 0px;
      margin-top: 0px;
      padding: 5px;
      width: 50px;
    }

    div.col {
      margin: auto;
      width: 100%;
      /*height: auto;*/
      word-break: break-word;
      padding: 10 0 10 0;
      text-align: center;
    }

    .pmsv {
      width: 60px;
      height: 60px;
    }

    h5 {
      font-size: 15px;
    }

    h1 {
      font-size: 22px;
    }





    @media print {
      .form-impressao {
        print-color-adjust: exact;
        -webkit-print-color-adjust: exact;
        position: absolute !important;
        top: 0;
      }

      .no-print,
      .no-print * {
        display: none !important;
        height: 0 !important;
      }

      /* classe para resize de impressao */
      .fotos {
        max-height: 100px !important;
        height: 100% !important;
      }
    }




  }
</style>




<?php

include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);
?>
<!-- A definição do html aqui n esta fazendo diferença pq ele está sendo carregado em um
    arquivo html então está carregando tudo isso dentro de uma div e não é reconhecido -->
<!DOCTYPE html>
<html lang="pt-br">


<head>
  <title>Relatório (RDO)</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="sv.ico">

  <style>
    @import url(https://allfont.net/allfont.css?fonts=english-111-vivace-bt);

    h1 {
      font-family: 'English 111 Vivace BT', arial;
    }

    #page-break {
      page-break-before: always;
      widows: 3;
      orphans: 3;
    }


    @media print {
      .form-impressao {
        print-color-adjust: exact;
        -webkit-print-color-adjust: exact;
        position: absolute !important;
        top: 0;
      }

      .no-print,
      .no-print * {
        display: none !important;
        height: 0 !important;
      }

    }
  </style>

  <?php
  $cd_Relatorio = $_REQUEST["cd_Relatorio"];

  try {
    $sql = $conn->prepare("SELECT r.*, GROUP_CONCAT(tp.nm_tipoPeriodo SEPARATOR ', ') As Periodo FROM relatorioview r
    INNER JOIN relatorio_has_tipo_periodo rhtp
    ON r.cd_Relatorio = rhtp.cd_Relatorio
    INNER JOIN tipo_periodo tp
    ON rhtp.cd_tipoPeriodo = tp.cd_tipoPeriodo
    WHERE r.cd_Relatorio = ?");
    $sql->bind_param('i', $cd_Relatorio);
    $sql->execute();
    $res = $sql->get_result();

    $rowRelatorio = $res->fetch_object();
  } catch (mysqli_sql_exception $e) {
    print "<script>alert('Ocorreu um erro interno ao buscar dados do relatório');
                  window.history.go(-1);</script>";
    criaLogErro($e);
  }
  print '<form action="?page=salvarrelatorio" method="POST" >
        <input type="hidden" name="acaorelatorio" value="editarrelatorio">
        <input type="text" name="cd_Relatorio" hidden value=' . $cd_Relatorio . '>';
  print "<button type='submit' class='btn btn-success mb-3 no-print'>Alterar situação</button>
  <div class='mb-3 no-print' >
  <label>Situação do Relatório</label>";

  try {
    $sql = "SELECT * FROM situacao_relatorio";

    $res = $conn->query($sql);
  } catch (mysqli_sql_exception $e) {
    print "<script>alert('Ocorreu um erro interno ao buscar dados de periodos');
              location.href='painel.php';</script>";
    criaLogErro($e);
  }


  print "<select class='form-select situacao ' name='tp_RelaSituacao' >";

  print "<option value='$rowRelatorio->cd_situacaoRelatorio' readonly selected hidden class='text-center'>$rowRelatorio->nm_situacaoRelatorio</option>";

  print "<datalist>";
  while ($row = $res->fetch_object()) {

    print "<option class='text-center' value={$row->cd_situacaoRelatorio}>" . $row->nm_situacaoRelatorio . "</option>";
  }

  print "</datalist>";
  print "</select>
  </div>
  </form>

  <div style='display: flex; flex-direction: row-reverse;'>
      <div>
          <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvarrelatorio&acaorelatorio=excluirRelatorio&cd_Relatorio=" . $cd_Relatorio . "';}else{false;}\" class='btn btn-danger mb-3 no-print'>Excluir</button>
      </div>
      <div class='mx-3'>
          <button onclick=window.print() class='btn btn-warning mb-3 no-print'>Imprimir</button>
      </div>

          </div>";
  ?>

</head>

<body>



  <div class="form-impressao">
    <header>
      <div class='container-fluid'>
        <div class='container mt-3 text-center'>
          <h1 id="tituloImpressao">
            <img class="pmsv" src="./relatorio/img/padrao.png" width='90' height='90'>
            Prefeitura Municipal de São Vicente
          </h1>
        </div>
        <div class='container text-center'>
          <h5>Cidade Monumento da História Pátria</h5>
          <h5>Cellula Mater da Nacionalidade</h5>
        </div>
      </div>

    </header>


    <main>

      <div class="container mt-3 text-center">
        <div class="row border border-dark border-1 mb-3">
          <div class="col bg-secondary bg-opacity-50" style="font-weight: bold">
            Relatório Diário de Obra (RDO)
          </div>
        </div>

        <div class="row mb-3">
          <?php

          if ($rowRelatorio->nm_situacaoRelatorio === 'Pendente') {
            print '<div id="fst" class="col-3 border border-dark border-1 bg-warning">';
          }


          if ($rowRelatorio->nm_situacaoRelatorio === 'Aprovado') {
            print '<div id="fst" class="col-3 border border-dark border-1 bg-success">';
          }

          if ($rowRelatorio->nm_situacaoRelatorio === 'Recusado') {
            print '<div id="fst" class="col-3 border border-dark border-1 bg-danger">';
          }

          print $rowRelatorio->nm_situacaoRelatorio;
          ?>
        </div>

        <div class="col-4"></div>

        <div class="col-3  border border-dark border-1 bg-secondary bg-opacity-50" style="font-weight: bold">
          Relatório
        </div>

        <div class='col-2 border border-start-0 border-dark border-1'>
          <?php
          echo "nº $rowRelatorio->num_Relatorio"
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-50" style="font-weight: bold">
          Informações do Relatório
        </div>
      </div>

      <div class="row">
        <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
          Responsável Técnico
        </div>
        <div class="col-9 border border-start-0 border-bottom-0 border-dark border-1">
          <?php
          echo $rowRelatorio->nm_TecResponsavel;
          ?>
        </div>
      </div>


      <div class="row">
        <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
          E-mail
        </div>
        <div class="col-9 border border-start-0 border-dark border-1">
          <?php
          echo $rowRelatorio->ds_Email_TecResponsavel;
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
          Contratante
        </div>
        <div class="col-9 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->nm_Contratante;
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
          Obra-Local
        </div>
        <div class="col-9 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->nm_Escola . " - " . $rowRelatorio->ds_Local;
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
          Prazo Contratual
        </div>
        <div class="col-4 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->pr_Total;
          ?>
        </div>
        <div class="col-3 border border-start-0 border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
          Contrato
        </div>
        <div class="col-2 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo "nº $rowRelatorio->cd_Contrato";
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
          Prazo Decorrido
        </div>
        <div class="col-4 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->pr_Decorrido;
          ?>
        </div>
        <div class="col-3 border border-start-0 border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
          Data do Relatório
        </div>
        <div class="col-2 border border-start-0 border-top-0 border-dark border-1">
          <?php
          //***Variável abaixo para receber valor da data e hora do Relatório***
          $dataParaMudar = $rowRelatorio->dt_Carimbo;

          //***Variável abaixo para receber o valor e alterar para formatação brasileira***
          $dataFormatada = DateTime::createFromFormat("Y-m-d H:i:s", $dataParaMudar);

          //***Retorna a data formatada PT-BR  ***
          echo $dataFormatada->format("d/m/Y");
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-3 border border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
          Prazo a Vencer
        </div>
        <div class="col-4 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->pr_Vencer;
          ?>
        </div>
        <div class="col-3 border border-start-0 border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
          Dia da Semana
        </div>
        <div class="col-2 border border-start-0 border-top-0 border-dark border-1">
          <?php
          //Variável que recebe o valor correspondente ao dia da semana em inglês
          //$dataFormatadaNova = DateTime::createFromFormat("w", $dataParaMudar);

          //Valor do dia da semana em inglês
          $diaSemana = date("l", strtotime($dataParaMudar));

          //$diaSemana = $dayofweek; //Valor do dia da semana em inglês
          $allweekdays = array("Sunday" => "Domingo", "Monday" => "Segunda-feira", "Tuesday" => "Terça-feira", "Wednesday" => "Quarta-feira", "Thursday" => "Quinta-feira", "Friday" => "Sexta-feira", "Saturday" => "Sábado");
          echo $allweekdays[$diaSemana];
          ?>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-3 border border-dark border-1 bg-secondary bg-opacity-25">
          Responsável no Local
        </div>
        <div class="col-9 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->nm_LocResponsavel;
          ?>
        </div>
      </div>

      <?php
      // *** INFORMAÇÕES DA OBRA ***
      ?>

      <div class="row">
        <div class="col border border-dark border-1 bg-secondary bg-opacity-50" style="font-weight: bold">
          Informações da Obra
        </div>
      </div>

      <div class="row">
        <div class="col-3 border border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
          Situação da Obra
        </div>
        <div class="col-4 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->nm_situacaoObra;
          ?>
        </div>
        <div class="col-3 border border-start-0 border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
          Conclusão
        </div>
        <div class="col-2 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->pt_Conclusao . "%";
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-3 border border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
          Condição
        </div>
        <div class="col-4 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->nm_tipoCondicao;
          ?>
        </div>
        <div class="col-3 border border-start-0 border-top-0 border-dark border-1 bg-secondary bg-opacity-25">
          Período
        </div>
        <div class="col-2 border border-start-0 border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->Periodo;
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-3 border border-top-0 border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
          Tempo
        </div>
        <div class="col-4 border border-start-0 border-top-0 border-bottom-0 border-dark border-1">
          <?php
          echo $rowRelatorio->nm_tipoTempo;
          ?>
        </div>
        <div class="col-3 border border-start-0 border-top-0 border-bottom-0 border-dark border-1 bg-secondary bg-opacity-25">
          Total de Mão de Obra
        </div>
        <div class="col-2 border border-start-0 border-top-0 border-bottom-0 border-dark border-1">
          <?php
          echo $rowRelatorio->qt_totalMaoDeObra;
          ?>
        </div>
      </div>



      <div class="row">
        <div class="col-2 border border-end-0 border-dark border-1 bg-secondary bg-opacity-25">Ajudante</div>
        <div class="col-2 border border-end-0 border-dark border-1 bg-secondary bg-opacity-25">Eletricista</div>
        <div class="col-2 border border-end-0 border-dark border-1 bg-secondary bg-opacity-25">Pedreiro</div>
        <div class="col-2 border border-end-0 border-dark border-1 bg-secondary bg-opacity-25">Servente</div>
        <div class="col-2 border border-end-0 border-dark border-1 bg-secondary bg-opacity-25">Mão de Obra Direta</div>
        <div class="col-2 border border-dark border-1 bg-secondary bg-opacity-25">Mestre de Obra</div>
      </div>

      <div class="row mb-3">
        <div class="col-2 border border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->qt_Ajudantes;
          ?>
        </div>
        <div class="col-2 border border-top-0 border-start-0 border-dark border-1">
          <?php
          echo $rowRelatorio->qt_Eletricistas;
          ?>
        </div>
        <div class="col-2 border border-top-0 border-start-0 border-dark border-1">
          <?php
          echo $rowRelatorio->qt_Pedreiros;
          ?>
        </div>
        <div class="col-2 border border-top-0 border-start-0 border-dark border-1">
          <?php
          echo $rowRelatorio->qt_Serventes;
          ?>
        </div>
        <div class="col-2 border border-top-0 border-start-0 border-dark border-1">
          <?php
          echo $rowRelatorio->qt_MaoDireta;
          ?>
        </div>
        <div class="col-2 border border-top-0 border-start-0 border-dark border-1">
          <?php
          echo $rowRelatorio->qt_Mestres;
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col border border-dark border-1 bg-secondary bg-opacity-50" style="font-weight: bold">
          Descrição de Atividade realizada
        </div>
      </div>

      <div class="row mb-3">
        <div class="col border border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->tp_AtivRealizada;
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col border border-dark border-1 bg-secondary bg-opacity-50" style="font-weight: bold">
          Comentários
        </div>
      </div>

      <div class="row mb-3">
        <div class="col border border-top-0 border-dark border-1">
          <?php
          echo $rowRelatorio->tp_Comentario;
          ?>
        </div>
      </div>


      <div class="row">
        <div class="col border border-dark border-1 bg-secondary bg-opacity-50" style="font-weight: bold">
          Fotos
        </div>
      </div>

      <?php
      try {
        $sql = $conn->prepare("SELECT * FROM foto WHERE cd_Relatorio = ?");
        $sql->bind_param('i', $cd_Relatorio);
        $sql->execute();
        $resFotos = $sql->get_result();
      } catch (mysqli_sql_exception $e) {
        print "<script>alert('Ocorreu um erro interno ao buscar dados do relatório');
                        window.history.go(-1);</script>";
        criaLogErro($e);
      }

      ?>

      <div class="row mb-3">
        <div class="col border border-top-0 border-dark border-1">
          <?php
          while ($rowFotos = $resFotos->fetch_object()) {
            echo '<img class="fotos" src="data:image/png;base64,' . base64_encode($rowFotos->img_foto) . '" />';
          }
          ?>
        </div>
      </div>


      <div class="row">
        <div class="col mb-3">__________________________________________________</div>
      </div>

      <div class="row">
        <div class="col">Responsável Técnico</div>
      </div>

  </div>


  </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"></script>



</body>



</html>