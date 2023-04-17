<style>

	#keepAll {
		word-break: keep-all;
	}
	
	#breakWord {
    word-break: break-word;
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

<?php
include_once('function-seduc.php');

redirecionamentoPorAutoridade(3);
?>

<section id="servicos" class="caixa">
    <div>
        <div class="secao-title">
            <h3>Lista de Gráficos</h3>
        </div>

        <div style="overflow-x:auto;">


		<form action="?page=salvarrelatorio" enctype='multipart/form-data' id="relatorio_form" method="POST">
        <input type="hidden" name="acaorelatorio" value="cadastrarRelatorio">
        <div class="mb-3">
            <label>Referência da Obra</label>
            <?php
            try {
                $sql = $conn->prepare("SELECT COUNT(DISTINCT cd_Contrato) FROM `obra`");

            
                $sql->execute();

                $res = $sql->get_result();
            } catch (mysqli_sql_exception $e) {
                print "<script>alert('Ocorreu um erro interno ao buscar dados de situacao de obra');
                    location.href='painel.php';</script>";
                criaLogErro($e);
            }

            print "<select class='form-select obra' name='cd_Obra' >";
            print "<datalist>";
            print "<option value='' disabled selected>Selecione o contrato / obra de referência / local</option>";


            while ($row = $res->fetch_object()) {

                print "<option value={$row->cd_Obra}>$row->tp_Servico: $row->tp_AtividadeDescricao / $row->nm_Escola</option>";
            }
            print "</datalist>";
            print "</select>";
            ?>
        </div>

















            <?php

            require_once('function-seduc.php');

            try {
                if (isset($_REQUEST['pendente'])) {
                    $sql = "SELECT * FROM relatorioview r 
                            WHERE nm_situacaoRelatorio LIKE 'Pendente' ORDER BY num_Relatorio ";
                } else {
                    $sql = "SELECT * FROM relatorioview r 
                            ORDER BY nm_situacaoRelatorio <> 'Pendente', num_Relatorio DESC";
                }
                $res = $conn->query($sql);
                $qtd = $res->num_rows;
            } catch (mysqli_sql_exception $e) {
                /*
                print "<script>alert('Ocorreu um erro interno ao buscar dados dos relatórios');
                                location.href='painel.php';</script>";
                */
                criaLogErro($e);
            }



            if ($qtd > 0) {
                print "<table class='table table-hover table-striped table-bordered'>";
                print "<tr>";

                print "<th id='keepAll' class='align-middle text-center'>Nº</th>";
                print "<th id='keepAll' class='align-middle text-center'>Escola</th>";
                print "<th id='keepAll' class='align-middle text-center'>Nº do Contrato</th>";
                print "<th id='keepAll' class='align-middle text-center'>Fornecedor</th>";
                print "<th id='keepAll' class='align-middle text-center'>Atividade Realizada</th>";
                print "<th id='keepAll' class='align-middle text-center'>Situação do Relatório</th>";
                print "<th id='keepAll' class='align-middle text-center'>Data</th>";

                print "<th class='align-middle text-center'>Visualizar</th>";

                print "</tr>";
                while ($row = $res->fetch_object()) {
                    print "<tr>";

                    print "<td class='align-middle text-center'>" . $row->num_Relatorio . "</td>";
                    print "<td class='align-middle'>" . $row->nm_Escola . "</td>";
                    print "<td class='align-middle text-center'>" . $row->num_contrato . "</td>";
                    print "<td class='align-middle'>" . $row->nm_Fornecedor . "</td>";
                    print "<td class='align-middle text-center'>" . $row->tp_AtivRealizada . "</td>";
                    print "<td class='align-middle text-center'>" . $row->nm_situacaoRelatorio . "</td>";


                    //***Variável abaixo para receber valor da data e hora do Relatório***
                    $dataParaMudar = $row->dt_Carimbo;

                    //***Variável abaixo para receber o valor e alterar para formatação brasileira***
                    $dataFormatada = DateTime::createFromFormat("Y-m-d H:i:s", $dataParaMudar);

                    //***Retorna a data formatada PT-BR  ***
                    $dataFormatada->format("d/m/Y");

                    print "<td id='keepAll' class='align-middle text-center'>" . $dataFormatada->format('d/m/Y') . "</td>";

                    print  "<td class='align-middle text-center'>
      <button onclick=\"location.href='?page=ver_relatorio&cd_Relatorio=" . $row->cd_Relatorio . "';\" class='btn btn-warning align-middle text-center'>Abrir</button>
      </td>";
                    print "</tr>";
                }
                print "</table>";
            } else
                print "<p class='alert alert-danger'>Não foi possível encontrar resultados!</p>";

            ?>

        </div>
    </div>

</section>