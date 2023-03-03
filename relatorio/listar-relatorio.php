<style>
 
 #grid-table>div.row{
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
    margin-top: 0px;
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

<section id="servicos" class="caixa">
      <div>
      <div>
      <div class="secao-title">
<h3>Lista de Relatórios</h3>
</div>
        <div>

          <div>
    <div> 

<?php

require_once('function-seduc.php');

$sql = "SELECT * FROM relatorioview order by num_Relatorio";

$res = $conn->query($sql);

$qtd = $res->num_rows;

if ($qtd > 0) {
    print "<table class='table table-hover table-striped table-bordered'>";
    print "<tr>";
    
    print "<th>Nº do Relatório</th>";
    print "<th>Nome da Escola</th>";
    print "<th>Nº do Contrato</th>";
    print "<th>Fornecedor</th>";
    print "<th>Atividade Realizada</th>";
    print "<th>Situação do Relatório</th>";
    print "<th>Data do Relatório</th>";
    
    print "<th>Click</th>";

    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";

        print "<td class='align-middle'>" . $row->num_Relatorio . "</td>";
        print "<td class='align-middle'>" . $row->nm_Escola . "</td>";
        print "<td class='align-middle'>" . $row->num_contrato . "</td>";
        print "<td class='align-middle'>" . $row->nm_Fornecedor . "</td>";
        print "<td class='align-middle'>" . $row->tp_AtivRealizada . "</td>";
        print "<td class='align-middle'>" . $row->nm_situacaoRelatorio . "</td>";


        //***Variável abaixo para receber valor da data e hora do Relatório***
        $dataParaMudar = $row->dt_Carimbo;
  
        //***Variável abaixo para receber o valor e alterar para formatação brasileira***
        $dataFormatada = DateTime::createFromFormat("Y-m-d H:i:s", $dataParaMudar);
  
        //***Retorna a data formatada PT-BR  ***
        $dataFormatada->format("d/m/Y");
  
        print "<td class='align-middle'>" . $dataFormatada->format('d/m/Y') . "</td>";
  
      print  "<td>
      <button onclick=\"location.href='?page=ver_relatorio&cd_Relatorio=" . $row->cd_Relatorio . "';\" class='btn btn-warning mb-3'>Abrir</button>
      </td>";
print "</tr>";
    }
    print "</table>";
} else
    print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";

    ?>

    </div>
    </div>
    </div>    
    </div>
    </div>    
    </div>
</section>